<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * リレーション: ユーザー
     *
     * @return HasOne<User>
     */
    public function user(): HasOne
    {
        return $this->hasOne(
            related: User::class,
            foreignKey: 'borrower_id',
        );
    }

    /**
     * リレーション: 書籍
     *
     * @return HasOne<Book>
     */
    public function book(): HasOne
    {
        return $this->hasOne(related: Book::class);
    }
}
