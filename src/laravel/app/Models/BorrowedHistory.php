<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class BorrowedHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrowed_at',
        'returned_at',
        'status',
    ];

    protected $casts = [
        'borrowed_at' => 'timestamp',
        'returned_at' => 'timestamp',
    ];
}
