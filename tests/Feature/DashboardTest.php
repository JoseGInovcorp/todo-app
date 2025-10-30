<?php

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guests are redirected to the login page', function () {
    $this->get('/dashboard')->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/dashboard');

    $response->assertStatus(200);
    $response->assertInertia(
        fn($assert) => $assert
            ->component('Dashboard')
            ->has('totalTasks')
            ->has('pendingTasks')
            ->has('completedTasks')
            ->has('overdueTasks')
    );
});

test('dashboard shows correct task counters', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create test tasks
    Task::factory()->create(['user_id' => $user->id, 'is_completed' => false]);
    Task::factory()->create(['user_id' => $user->id, 'is_completed' => true]);
    Task::factory()->create([
        'user_id' => $user->id,
        'is_completed' => false,
        'due_date' => now()->subDay()->toDateString()
    ]);

    $response = $this->get('/dashboard');

    $response->assertInertia(
        fn($assert) => $assert
            ->component('Dashboard')
            ->where('totalTasks', 3)
            ->where('completedTasks', 1)
            ->where('overdueTasks', 1)
    );
});

test('dashboard shows priority statistics correctly', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create tasks with different priorities
    Task::factory()->create(['user_id' => $user->id, 'priority' => 'alta']);
    Task::factory()->create(['user_id' => $user->id, 'priority' => 'alta']);
    Task::factory()->create(['user_id' => $user->id, 'priority' => 'media']);
    Task::factory()->create(['user_id' => $user->id, 'priority' => 'baixa']);

    $response = $this->get('/dashboard');

    $response->assertInertia(
        fn($assert) => $assert
            ->component('Dashboard')
            ->where('highPriorityTasks', 2)
            ->where('mediumPriorityTasks', 1)
            ->where('lowPriorityTasks', 1)
    );
});

test('dashboard shows today and weekly statistics', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create a task today
    Task::factory()->create([
        'user_id' => $user->id,
        'created_at' => now(),
    ]);

    // Create a completed task today
    Task::factory()->create([
        'user_id' => $user->id,
        'is_completed' => true,
        'updated_at' => now(),
    ]);

    $response = $this->get('/dashboard');

    $response->assertInertia(
        fn($assert) => $assert
            ->component('Dashboard')
            ->where('todayCreated', 2)
            ->where('todayCompleted', 1)
            ->has('thisWeekCreated')
            ->has('thisWeekCompleted')
    );
});

test('dashboard only shows current user tasks', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    // Create tasks for user2
    Task::factory()->count(3)->create(['user_id' => $user2->id]);

    // Login as user1
    $this->actingAs($user1);

    $response = $this->get('/dashboard');

    $response->assertInertia(
        fn($assert) => $assert
            ->component('Dashboard')
            ->where('totalTasks', 0)
            ->where('pendingTasks', 0)
            ->where('completedTasks', 0)
    );
});
