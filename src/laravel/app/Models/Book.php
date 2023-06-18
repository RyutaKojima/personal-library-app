<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * @return BelongsTo<BookStock, Book>
     */
    public function bookStock(): BelongsTo
    {
        return $this->belongsTo(BookStock::class);
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
