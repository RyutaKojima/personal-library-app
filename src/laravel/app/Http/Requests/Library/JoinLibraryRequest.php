<?php

declare(strict_types=1);

namespace App\Http\Requests\Library;

use Illuminate\Foundation\Http\FormRequest;

final class JoinLibraryRequest extends FormRequest
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
            'identification_code' => ['required', 'string'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'identification_code' => '図書館の識別コード',
        ];
    }
}
