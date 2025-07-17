<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'stack',
        'active',
        'due_date',
        'url',
    ];

    protected $casts = [
        'due_date' => 'date',
        'active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->due_date) {
                $model->due_date = now();
            }
        });
    }
}
