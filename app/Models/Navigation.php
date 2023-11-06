<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'items',
        'bg_color',
        'items_sidebar'
    ];

    protected $casts = [
        'items' => 'array',
        'items_sidebar' => 'array'
    ];
}
