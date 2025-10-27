<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        // Filtro por estado (pendente, concluída, todas)
        if ($request->filled('status')) {
            if ($request->status === 'completed') {
                $query->where('is_completed', true);
            } elseif ($request->status === 'pending') {
                // Pendentes = não concluídas que não estão em atraso
                $query->pendingNotOverdue();
            }
            // 'all' não aplica filtro
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
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        if ($sort === 'due_date') {
            $query->orderByRaw('due_date IS NULL, due_date ' . $direction);
        } else {
            $query->orderBy($sort, $direction);
        }

        $tasks = $query->paginate(10)->appends($request->query());

        return view('tasks.index', compact('tasks'));
    }

    public function create(Request $request)
    {
        $task = null;

        // Se foi passado um ID para duplicar
        if ($request->filled('duplicate')) {
            $task = Task::find($request->duplicate);
        }

        return view('tasks.create', compact('task'));
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
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
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
     * Toggle da conclusão de uma tarefa via AJAX
     */
    public function toggleComplete(Task $task)
    {
        $this->authorize('update', $task);
        $task->update(['is_completed' => !$task->is_completed]);

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'is_completed' => $task->is_completed,
                'message' => $task->is_completed
                    ? 'Tarefa marcada como concluída!'
                    : 'Tarefa marcada como pendente!'
            ]);
        }

        return redirect()->back()->with('success', 'Estado da tarefa atualizado!');
    }
}
