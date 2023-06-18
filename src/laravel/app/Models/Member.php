<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
    ];

    /**
     * リレーション: 図書館
     *
     * @return HasOne<Library>
     */
    public function library(): HasOne
    {
        return $this->hasOne(Library::class);
    }

    /**
     * リレーション: ユーザー
     *
     * @return HasOne<User>
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
