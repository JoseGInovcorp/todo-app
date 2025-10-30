<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('title is required when creating task', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/tasks', [
        'priority' => 'alta',
    ]);

    $response->assertSessionHasErrors(['title']);
});

test('title cannot be empty when creating task', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/tasks', [
        'title' => '',
        'priority' => 'alta',
    ]);

    $response->assertSessionHasErrors(['title']);
});

test('title cannot exceed maximum length', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/tasks', [
        'title' => str_repeat('a', 256), // 256 characters
        'priority' => 'alta',
    ]);

    $response->assertSessionHasErrors(['title']);
});

test('priority is required when creating task', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/tasks', [
        'title' => 'Test Task',
    ]);

    $response->assertSessionHasErrors(['priority']);
});

test('priority must be valid value', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/tasks', [
        'title' => 'Test Task',
        'priority' => 'invalid',
    ]);

    $response->assertSessionHasErrors(['priority']);
});

test('priority accepts valid values', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $validPriorities = ['alta', 'media', 'baixa'];

    foreach ($validPriorities as $priority) {
        $response = $this->post('/tasks', [
            'title' => "Test Task {$priority}",
            'priority' => $priority,
        ]);

        $response->assertRedirect('/tasks');
        $response->assertSessionHasNoErrors();
    }
});

test('due_date must be valid date format', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/tasks', [
        'title' => 'Test Task',
        'priority' => 'alta',
        'due_date' => 'invalid-date',
    ]);

    $response->assertSessionHasErrors(['due_date']);
});

test('due_date accepts valid date format', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/tasks', [
        'title' => 'Test Task',
        'priority' => 'alta',
        'due_date' => '2025-12-31',
    ]);

    $response->assertRedirect('/tasks');
    $response->assertSessionHasNoErrors();
});

test('description is optional', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/tasks', [
        'title' => 'Test Task',
        'priority' => 'alta',
    ]);

    $response->assertRedirect('/tasks');
    $response->assertSessionHasNoErrors();
});

test('description can be long text', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $longDescription = str_repeat('This is a long description. ', 50);

    $response = $this->post('/tasks', [
        'title' => 'Test Task',
        'priority' => 'alta',
        'description' => $longDescription,
    ]);

    $response->assertRedirect('/tasks');
    $response->assertSessionHasNoErrors();
});

test('validation applies to updates as well', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $task = Task::factory()->create(['user_id' => $user->id]);

    $response = $this->put("/tasks/{$task->id}", [
        'title' => '', // Empty title
        'priority' => 'invalid', // Invalid priority
    ]);

    $response->assertSessionHasErrors(['title', 'priority']);
});

test('successful task creation with all fields', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/tasks', [
        'title' => 'Complete Project',
        'description' => 'This is a detailed description of the task.',
        'priority' => 'alta',
        'due_date' => '2025-12-31',
    ]);

    $response->assertRedirect('/tasks');
    $response->assertSessionHasNoErrors();

    $this->assertDatabaseHas('tasks', [
        'title' => 'Complete Project',
        'description' => 'This is a detailed description of the task.',
        'priority' => 'alta',
        'due_date' => '2025-12-31',
        'user_id' => $user->id,
        'is_completed' => false,
    ]);
});
