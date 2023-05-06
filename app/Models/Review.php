<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $review
 * @property int $evaluation
 * @property-read \Carbon\Carbon|null $created_at
 * @property-read \Carbon\Carbon|null $updated_at
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'review',
        'evaluation',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
