<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'author',
        'publisher',
    ];

    /**
     * リレーション: 書籍
     *
     * @return HasOne<BookStock>
     */
    public function bookStock(): HasOne
    {
        return $this->hasOne(BookStock::class);
    }

    /**
     * リレーション: 貸出履歴
     *
     * @return HasMany<BorrowedHistory>
     */
    public function borrowedHistories(): HasMany
    {
        return $this->hasMany(BorrowedHistory::class);
    }
}
