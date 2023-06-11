<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

final class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<string>>
     */
    public function rules(): array
    {
        return [
            'account_id' => ['required', 'string', 'email:rfc,strict,dns,spoof'],
            'password' => ['required', 'string'],
            'name' => ['required', 'string'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'account_id' => 'アカウントID',
            'password' => 'パスワード',
            'name' => '表示名',
        ];
    }
}
