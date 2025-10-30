<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can list tasks on index page for authenticated user', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create tasks for this user
    Task::factory()->create(['title' => 'Tarefa A', 'user_id' => $user->id]);
    Task::factory()->create(['title' => 'Tarefa B', 'user_id' => $user->id]);

    $response = $this->get('/tasks');

    $response->assertStatus(200);
    // Since it's an Inertia response, check for component
    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskList')
            ->has('tasks.data', 2)
    );
});

it('requires authentication to access tasks', function () {
    $response = $this->get('/tasks');

    $response->assertRedirect('/login');
});

it('can create a new task when authenticated', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/tasks', [
        'title' => 'Nova tarefa',
        'description' => 'Descrição da tarefa',
        'priority' => 'alta',
        'due_date' => '2025-12-31',
    ]);

    // Check redirect
    $response->assertRedirect('/tasks');

    // Check database
    $this->assertDatabaseHas('tasks', [
        'title' => 'Nova tarefa',
        'description' => 'Descrição da tarefa',
        'priority' => 'alta',
        'due_date' => '2025-12-31',
        'user_id' => $user->id,
        'is_completed' => false,
    ]);
});

it('requires authentication to create tasks', function () {
    $response = $this->post('/tasks', [
        'title' => 'Nova tarefa',
        'priority' => 'alta',
    ]);

    $response->assertRedirect('/login');
});

it('can update an existing task when authenticated', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $task = Task::factory()->create([
        'title' => 'Antiga tarefa',
        'user_id' => $user->id
    ]);

    $response = $this->put("/tasks/{$task->id}", [
        'title' => 'Tarefa atualizada',
        'description' => 'Nova descrição',
        'priority' => 'media',
        'due_date' => '2025-11-30',
        'is_completed' => true,
    ]);

    $response->assertRedirect('/tasks');

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => 'Tarefa atualizada',
        'description' => 'Nova descrição',
        'priority' => 'media',
        'due_date' => '2025-11-30',
        'is_completed' => true,
    ]);
});

it('cannot update other users tasks', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $task = Task::factory()->create(['user_id' => $user2->id]);

    $this->actingAs($user1);

    $response = $this->put("/tasks/{$task->id}", [
        'title' => 'Tarefa modificada',
    ]);

    $response->assertStatus(403);
});

it('can soft delete a task when authenticated', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $task = Task::factory()->create(['user_id' => $user->id]);

    $response = $this->delete("/tasks/{$task->id}");

    $response->assertRedirect('/tasks');

    // Check soft delete
    $this->assertSoftDeleted('tasks', [
        'id' => $task->id,
    ]);
});

it('can toggle task completion status', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $task = Task::factory()->create([
        'user_id' => $user->id,
        'is_completed' => false
    ]);

    $response = $this->patch("/tasks/{$task->id}/toggle-complete");

    $response->assertRedirect();

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'is_completed' => true,
    ]);
});

it('validates required fields when creating task', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/tasks', []);

    $response->assertSessionHasErrors(['title', 'priority']);
});

it('validates priority field has correct value', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/tasks', [
        'title' => 'Test Task',
        'priority' => 'invalid_priority',
    ]);

    $response->assertSessionHasErrors(['priority']);
});
