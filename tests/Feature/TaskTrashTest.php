<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can view trashed tasks page', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/tasks-trash');

    $response->assertStatus(200);
    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskTrash')
    );
});

test('trashed tasks appear in trash page', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create and delete a task
    $task = Task::factory()->create(['user_id' => $user->id]);
    $task->delete();

    $response = $this->get('/tasks-trash');

    $response->assertStatus(200);
    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskTrash')
            ->has('tasks.data', 1)
    );
});

test('can restore a trashed task', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create and delete a task
    $task = Task::factory()->create(['user_id' => $user->id]);
    $task->delete();

    // Restore the task
    $response = $this->patch("/tasks/{$task->id}/restore");

    $response->assertRedirect('/tasks-trash');

    // Check task is restored
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'deleted_at' => null,
    ]);
});

test('cannot restore other users trashed tasks', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    // User2 creates and deletes a task
    $task = Task::factory()->create(['user_id' => $user2->id]);
    $task->delete();

    // User1 tries to restore it
    $this->actingAs($user1);
    $response = $this->patch("/tasks/{$task->id}/restore");

    $response->assertStatus(403);
});

test('can force delete a trashed task', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create and delete a task
    $task = Task::factory()->create(['user_id' => $user->id]);
    $task->delete();

    // Force delete the task
    $response = $this->delete("/tasks/{$task->id}/force-delete");

    $response->assertRedirect('/tasks-trash');

    // Check task is permanently deleted
    $this->assertDatabaseMissing('tasks', [
        'id' => $task->id,
    ]);
});

test('cannot force delete other users trashed tasks', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    // User2 creates and deletes a task
    $task = Task::factory()->create(['user_id' => $user2->id]);
    $task->delete();

    // User1 tries to force delete it
    $this->actingAs($user1);
    $response = $this->delete("/tasks/{$task->id}/force-delete");

    $response->assertStatus(403);
});

test('only shows current user trashed tasks', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    // User2 creates and deletes tasks
    $task1 = Task::factory()->create(['user_id' => $user2->id]);
    $task2 = Task::factory()->create(['user_id' => $user2->id]);
    $task1->delete();
    $task2->delete();

    // User1 checks trash
    $this->actingAs($user1);
    $response = $this->get('/tasks-trash');

    $response->assertInertia(
        fn($assert) => $assert
            ->component('TaskTrash')
            ->has('tasks.data', 0)
    );
});

test('deleted tasks increment today deleted counter', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create and delete a task today
    $task = Task::factory()->create(['user_id' => $user->id]);
    $task->delete();

    // Check dashboard shows deleted count
    $response = $this->get('/dashboard');

    $response->assertInertia(
        fn($assert) => $assert
            ->component('Dashboard')
            ->where('todayDeleted', 1)
    );
});

test('deleted tasks increment weekly deleted counter', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create and delete a task this week
    $task = Task::factory()->create(['user_id' => $user->id]);
    $task->delete();

    // Check dashboard shows weekly deleted count
    $response = $this->get('/dashboard');

    $response->assertInertia(
        fn($assert) => $assert
            ->component('Dashboard')
            ->where('thisWeekDeleted', 1)
    );
});
