<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class BookStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'max_stocks',
        'current_stocks',
    ];
}