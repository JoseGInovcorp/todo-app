<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        // Suporte para filtro simples da sidebar (converte para parâmetros específicos)
        if ($request->filled('filter')) {
            switch ($request->filter) {
                case 'pending':
                    $request->merge(['status' => 'pending']);
                    break;
                case 'completed':
                    $request->merge(['status' => 'completed']);
                    break;
                case 'overdue':
                    $request->merge(['due_date_filter' => 'overdue']);
                    break;
            }
        }

        // Filtro por estado (pendente, concluída, todas)
        if ($request->filled('status')) {
            if ($request->status === 'completed') {
                $query->where('is_completed', true);
            } elseif ($request->status === 'pending') {
                // Pendentes = não concluídas que não estão em atraso
                $query->pendingNotOverdue();
            } elseif ($request->status === 'all') {
                // 'all' não aplica filtro - mostra todas
            }
        } else {
            // Por defeito: mostrar apenas tarefas NÃO concluídas (pendentes + em atraso)
            $query->where('is_completed', false);
        }

        // Filtro por prioridade
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filtro por data de vencimento
        if ($request->filled('due_date_filter')) {
            $today = now()->toDateString();
            switch ($request->due_date_filter) {
                case 'overdue':
                    $query->whereNotNull('due_date')->where('due_date', '<', $today)->where('is_completed', false);
                    break;
                case 'today':
                    $query->whereDate('due_date', $today);
                    break;
                case 'this_week':
                    $startOfWeek = now()->startOfWeek()->toDateString();
                    $endOfWeek = now()->endOfWeek()->toDateString();
                    $query->whereBetween('due_date', [$startOfWeek, $endOfWeek]);
                    break;
            }
        }

        // Pesquisa por título
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Ordenação
        $sort = $request->get('sort', 'created_at_desc');

        switch ($sort) {
            case 'created_at_desc':
                $query->orderBy('created_at', 'desc');
                break;
            case 'created_at_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'due_date_asc':
                $query->orderByRaw('due_date IS NULL, due_date ASC');
                break;
            case 'due_date_desc':
                $query->orderByRaw('due_date IS NOT NULL DESC, due_date DESC');
                break;
            case 'priority_desc':
                $query->orderByRaw("CASE 
                    WHEN priority = 'alta' THEN 1 
                    WHEN priority = 'media' THEN 2 
                    WHEN priority = 'baixa' THEN 3 
                    ELSE 4 
                END");
                break;
            case 'priority_asc':
                $query->orderByRaw("CASE 
                    WHEN priority = 'baixa' THEN 1 
                    WHEN priority = 'media' THEN 2 
                    WHEN priority = 'alta' THEN 3 
                    ELSE 4 
                END");
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $tasks = $query->paginate(10)->appends($request->query());

        return inertia('TaskList', [
            'tasks' => $tasks,
            'filters' => $request->only(['search', 'status', 'priority', 'due_date_filter', 'sort']),
        ]);
    }

    public function create(Request $request)
    {
        $duplicateTask = null;

        // Se foi passado um ID para duplicar
        if ($request->filled('duplicate')) {
            $duplicateTask = Task::find($request->duplicate);
        }

        return inertia('TaskCreate', [
            'duplicateTask' => $duplicateTask,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:alta,media,baixa',
        ]);

        $validated['user_id'] = Auth::id();

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return inertia('TaskShow', [
            'task' => $task,
        ]);
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return inertia('TaskEdit', [
            'task' => $task,
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:alta,media,baixa',
            'is_completed' => 'boolean',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarefa eliminada com sucesso!');
    }

    /**
     * Toggle da conclusão de uma tarefa via AJAX/Inertia
     */
    public function toggleComplete(Task $task)
    {
        $this->authorize('update', $task);
        $task->update(['is_completed' => !$task->is_completed]);

        $message = $task->is_completed
            ? 'Tarefa marcada como concluída!'
            : 'Tarefa marcada como pendente!';

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'is_completed' => $task->is_completed,
                'message' => $message
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Mostrar tarefas eliminadas (soft deleted)
     */
    public function trash()
    {
        $tasks = Task::onlyTrashed()
            ->where('user_id', Auth::id())
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return inertia('TaskTrash', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Restaurar uma tarefa eliminada
     */
    public function restore($id)
    {
        $task = Task::onlyTrashed()
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $this->authorize('update', $task);

        $task->restore();

        return redirect()->route('tasks.trash')->with('success', 'Tarefa restaurada com sucesso!');
    }

    /**
     * Eliminar permanentemente uma tarefa
     */
    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $this->authorize('delete', $task);

        $task->forceDelete();

        return redirect()->route('tasks.trash')->with('success', 'Tarefa eliminada permanentemente!');
    }

    /**
     * Dashboard com métricas e estatísticas das tarefas
     */
    public function dashboard()
    {
        $userId = Auth::id();

        // Estatísticas básicas - usar os mesmos scopes do middleware
        $totalTasks = Task::where('user_id', $userId)->count();
        $completedTasks = Task::where('user_id', $userId)->completed()->count();
        $pendingTasks = Task::where('user_id', $userId)->pendingNotOverdue()->count();
        $trashedTasks = Task::onlyTrashed()->where('user_id', $userId)->count();

        // Tarefas em atraso - usar o mesmo scope do middleware
        $overdueTasks = Task::where('user_id', $userId)->overdue()->count();

        // Estatísticas por prioridade
        $highPriorityTasks = Task::where('user_id', $userId)->where('priority', 'alta')->count();
        $mediumPriorityTasks = Task::where('user_id', $userId)->where('priority', 'media')->count();
        $lowPriorityTasks = Task::where('user_id', $userId)->where('priority', 'baixa')->count();

        // Estatísticas de hoje
        $todayCreated = Task::where('user_id', $userId)
            ->whereDate('created_at', now()->toDateString())
            ->count();

        $todayCompleted = Task::where('user_id', $userId)
            ->where('is_completed', true)
            ->whereDate('updated_at', now()->toDateString())
            ->count();

        $todayDeleted = Task::onlyTrashed()
            ->where('user_id', $userId)
            ->whereDate('deleted_at', now()->toDateString())
            ->count();

        // Estatísticas desta semana (segunda a domingo)
        $thisWeekCreated = Task::where('user_id', $userId)
            ->whereBetween('created_at', [now()->startOfWeek(Carbon::MONDAY), now()->endOfWeek(Carbon::SUNDAY)])
            ->count();

        $thisWeekCompleted = Task::where('user_id', $userId)
            ->where('is_completed', true)
            ->whereBetween('updated_at', [now()->startOfWeek(Carbon::MONDAY), now()->endOfWeek(Carbon::SUNDAY)])
            ->count();

        $thisWeekDeleted = Task::onlyTrashed()
            ->where('user_id', $userId)
            ->whereBetween('deleted_at', [now()->startOfWeek(Carbon::MONDAY), now()->endOfWeek(Carbon::SUNDAY)])
            ->count();

        // Tarefas criadas semana passada
        $lastWeekCreated = Task::where('user_id', $userId)
            ->whereBetween('created_at', [
                now()->subWeek()->startOfWeek(Carbon::MONDAY),
                now()->subWeek()->endOfWeek(Carbon::SUNDAY)
            ])
            ->count();

        // Tarefas completadas semana passada
        $lastWeekCompleted = Task::where('user_id', $userId)
            ->where('is_completed', true)
            ->whereBetween('updated_at', [
                now()->subWeek()->startOfWeek(Carbon::MONDAY),
                now()->subWeek()->endOfWeek(Carbon::SUNDAY)
            ])
            ->count();

        // Próximas tarefas (próximos 7 dias)
        $upcomingTasks = Task::where('user_id', $userId)
            ->where('is_completed', false)
            ->whereNotNull('due_date')
            ->whereBetween('due_date', [now()->toDateString(), now()->addDays(7)->toDateString()])
            ->orderBy('due_date')
            ->limit(5)
            ->get();

        return inertia('Dashboard', compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'trashedTasks',
            'overdueTasks',
            'highPriorityTasks',
            'mediumPriorityTasks',
            'lowPriorityTasks',
            'todayCreated',
            'todayCompleted',
            'todayDeleted',
            'thisWeekCreated',
            'thisWeekCompleted',
            'thisWeekDeleted',
            'lastWeekCreated',
            'lastWeekCompleted',
            'upcomingTasks'
        ));
    }
}
