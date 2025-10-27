<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

use App\Models\User;

it('lists tasks on index page', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Task::factory()->create(['title' => 'Tarefa A']);
    Task::factory()->create(['title' => 'Tarefa B']);

    $response = $this->get('/tasks');

    $response->assertStatus(200);
    $response->assertSee('Tarefa A');
    $response->assertSee('Tarefa B');
});

it('creates a new task via POST', function () {
    $response = $this->post('/tasks', [
        'title' => 'Nova tarefa',
        'priority' => 'alta',
    ]);

    $response->assertRedirect('/tasks');
    $this->assertDatabaseHas('tasks', [
        'title' => 'Nova tarefa',
        'priority' => 'alta',
        'is_completed' => false,
    ]);
});

it('updates an existing task via PUT', function () {
    $task = Task::factory()->create(['title' => 'Antiga tarefa']);

    $response = $this->put("/tasks/{$task->id}", [
        'title' => 'Tarefa atualizada',
        'priority' => 'media',
        'is_completed' => true,
    ]);

    $response->assertRedirect('/tasks');
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => 'Tarefa atualizada',
        'priority' => 'media',
        'is_completed' => true,
    ]);
});

it('deletes a task via DELETE', function () {
    $task = Task::factory()->create();

    $response = $this->delete("/tasks/{$task->id}");

    $response->assertRedirect('/tasks');
    $this->assertDatabaseMissing('tasks', [
        'id' => $task->id,
    ]);
});
