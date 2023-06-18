<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class BookStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'max_stocks',
        'current_stocks',
    ];

    /**
     * リレーション: 書籍
     *
     * @return HasOne<Book>
     */
    public function book(): HasOne
    {
        return $this->hasOne(Book::class);
    }
}
