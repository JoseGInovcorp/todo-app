<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can filter tasks by status', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create tasks with different statuses
    Task::factory()->create(['user_id' => $user->id, 'is_completed' => false]);
    Task::factory()->create(['user_id' => $user->id, 'is_completed' => true]);

    // Filter by pending tasks
    $response = $this->get('/tasks?status=pending');
    $response->assertStatus(200);
    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskList')
            ->has('tasks.data', 1)
    );

    // Filter by completed tasks
    $response = $this->get('/tasks?status=completed');
    $response->assertStatus(200);
    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskList')
            ->has('tasks.data', 1)
    );
});

test('can filter tasks by priority', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create tasks with different priorities
    Task::factory()->create(['user_id' => $user->id, 'priority' => 'alta']);
    Task::factory()->create(['user_id' => $user->id, 'priority' => 'media']);
    Task::factory()->create(['user_id' => $user->id, 'priority' => 'baixa']);

    // Filter by high priority
    $response = $this->get('/tasks?priority=alta');
    $response->assertStatus(200);
    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskList')
            ->has('tasks.data', 1)
    );
});

test('can search tasks by title', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create tasks with different titles
    Task::factory()->create([
        'user_id' => $user->id,
        'title' => 'Estudar Laravel'
    ]);
    Task::factory()->create([
        'user_id' => $user->id,
        'title' => 'Aprender Vue.js'
    ]);

    // Search for Laravel
    $response = $this->get('/tasks?search=Laravel');
    $response->assertStatus(200);
    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskList')
            ->has('tasks.data', 1)
    );
});

test('can search tasks by description', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Task::factory()->create([
        'user_id' => $user->id,
        'title' => 'Tarefa 1',
        'description' => 'Estudar framework Laravel'
    ]);
    Task::factory()->create([
        'user_id' => $user->id,
        'title' => 'Tarefa 2',
        'description' => 'Aprender Vue.js'
    ]);

    // Search by description
    $response = $this->get('/tasks?search=framework');
    $response->assertStatus(200);
    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskList')
            ->has('tasks.data', 1)
    );
});

test('can filter overdue tasks', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create overdue task
    Task::factory()->create([
        'user_id' => $user->id,
        'due_date' => now()->subDay()->toDateString(),
        'is_completed' => false
    ]);

    // Create future task
    Task::factory()->create([
        'user_id' => $user->id,
        'due_date' => now()->addDay()->toDateString(),
        'is_completed' => false
    ]);

    // Filter overdue tasks
    $response = $this->get('/tasks?status=overdue');
    $response->assertStatus(200);
    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskList')
            ->has('tasks.data', 1)
    );
});

test('can combine multiple filters', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create tasks with different combinations
    Task::factory()->create([
        'user_id' => $user->id,
        'title' => 'Urgent Task',
        'priority' => 'alta',
        'is_completed' => false
    ]);
    Task::factory()->create([
        'user_id' => $user->id,
        'title' => 'Normal Task',
        'priority' => 'media',
        'is_completed' => false
    ]);

    // Filter by priority AND search
    $response = $this->get('/tasks?priority=alta&search=Urgent');
    $response->assertStatus(200);
    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskList')
            ->has('tasks.data', 1)
    );
});

test('returns empty results for non-matching filters', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Task::factory()->create([
        'user_id' => $user->id,
        'title' => 'Test Task',
        'priority' => 'baixa'
    ]);

    // Search for non-existing term
    $response = $this->get('/tasks?search=nonexistent');
    $response->assertStatus(200);
    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskList')
            ->has('tasks.data', 0)
    );
});
