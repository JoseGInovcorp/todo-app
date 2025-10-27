<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a pending task by default', function () {
    $task = Task::factory()->create([
        'title' => 'Primeira tarefa',
        'priority' => 'alta',
    ]);

    expect($task->id)->not->toBeNull()
        ->and($task->title)->toBe('Primeira tarefa')
        ->and($task->priority)->toBe('alta')
        ->and($task->is_completed)->toBeFalse();
});

it('can create a completed task explicitly', function () {
    $task = Task::factory()->create([
        'title' => 'Tarefa concluída',
        'priority' => 'media',
        'is_completed' => true,
    ]);

    expect($task->id)->not->toBeNull()
        ->and($task->title)->toBe('Tarefa concluída')
        ->and($task->priority)->toBe('media')
        ->and($task->is_completed)->toBeTrue();
});
