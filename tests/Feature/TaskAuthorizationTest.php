<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('users can only see their own tasks in list', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    // Create tasks for both users
    Task::factory()->count(3)->create(['user_id' => $user1->id]);
    Task::factory()->count(2)->create(['user_id' => $user2->id]);

    // User1 should only see their tasks
    $this->actingAs($user1);
    $response = $this->get('/tasks');

    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskList')
            ->has('tasks.data', 3)
    );
});

test('users cannot view other users tasks', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $task = Task::factory()->create(['user_id' => $user2->id]);

    $this->actingAs($user1);
    $response = $this->get("/tasks/{$task->id}");

    $response->assertStatus(403);
});

test('users cannot edit other users tasks', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $task = Task::factory()->create(['user_id' => $user2->id]);

    $this->actingAs($user1);
    $response = $this->put("/tasks/{$task->id}", [
        'title' => 'Modified Task',
        'priority' => 'alta',
    ]);

    $response->assertStatus(403);
});

test('users cannot delete other users tasks', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $task = Task::factory()->create(['user_id' => $user2->id]);

    $this->actingAs($user1);
    $response = $this->delete("/tasks/{$task->id}");

    $response->assertStatus(403);
});

test('users cannot toggle completion of other users tasks', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $task = Task::factory()->create(['user_id' => $user2->id]);

    $this->actingAs($user1);
    $response = $this->patch("/tasks/{$task->id}/toggle-complete");

    $response->assertStatus(403);
});

test('users can view their own task details', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $task = Task::factory()->create(['user_id' => $user->id]);

    $response = $this->get("/tasks/{$task->id}");

    $response->assertStatus(200);
    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskShow')
            ->where('task.id', $task->id)
    );
});

test('users can edit their own tasks', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $task = Task::factory()->create(['user_id' => $user->id]);

    $response = $this->put("/tasks/{$task->id}", [
        'title' => 'Updated Task',
        'priority' => 'media',
    ]);

    $response->assertRedirect('/tasks');
    $response->assertSessionHasNoErrors();
});

test('users can delete their own tasks', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $task = Task::factory()->create(['user_id' => $user->id]);

    $response = $this->delete("/tasks/{$task->id}");

    $response->assertRedirect('/tasks');

    $this->assertSoftDeleted('tasks', [
        'id' => $task->id,
    ]);
});

test('users can toggle completion of their own tasks', function () {
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

test('task creation automatically assigns to authenticated user', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/tasks', [
        'title' => 'New Task',
        'priority' => 'alta',
    ]);

    $response->assertRedirect('/tasks');

    $this->assertDatabaseHas('tasks', [
        'title' => 'New Task',
        'user_id' => $user->id,
    ]);
});

test('dashboard only shows authenticated user statistics', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    // Create tasks for user2
    Task::factory()->count(5)->create(['user_id' => $user2->id]);

    // Login as user1 and check dashboard
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
