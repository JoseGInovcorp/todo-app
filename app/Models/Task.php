<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'priority',
        'is_completed',
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_completed' => 'boolean',
    ];

    /**
     * Scopes para filtros
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('is_completed', false);
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('is_completed', true);
    }

    public function scopeHighPriority(Builder $query): Builder
    {
        return $query->where('priority', 'alta');
    }

    public function scopeOverdue(Builder $query): Builder
    {
        return $query->whereNotNull('due_date')
            ->where('due_date', '<', now()->toDateString())
            ->where('is_completed', false);
    }

    public function scopePendingNotOverdue(Builder $query): Builder
    {
        return $query->where('is_completed', false)
            ->where(function ($q) {
                $q->whereNull('due_date')
                    ->orWhere('due_date', '>=', now()->toDateString());
            });
    }

    /**
     * Accessors
     */
    public function getIsOverdueAttribute(): bool
    {
        return $this->due_date &&
            $this->due_date->toDateString() < now()->toDateString() &&
            !$this->is_completed;
    }

    public function getPriorityColorAttribute(): string
    {
        return [
            'alta' => 'text-red-600 bg-red-100',
            'media' => 'text-yellow-600 bg-yellow-100',
            'baixa' => 'text-green-600 bg-green-100',
        ][$this->priority] ?? 'text-gray-600 bg-gray-100';
    }

    public function getPriorityLabelAttribute(): string
    {
        return [
            'alta' => 'Alta',
            'media' => 'Média',
            'baixa' => 'Baixa',
        ][$this->priority] ?? 'Média';
    }

    public function getDueDateFormattedAttribute(): ?string
    {
        return $this->due_date?->format('d/m/Y');
    }

    /**
     * Relacionamentos
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
