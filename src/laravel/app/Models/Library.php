<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Library extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'identification_code',
    ];

    /**
     * リレーション: メンバ
     *
     * @return HasMany<Member>
     */
    public function members(): hasMany
    {
        return $this->hasMany(Member::class);
    }

    /**
     * リレーション: 書籍
     *
     * @return HasMany<Book>
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
