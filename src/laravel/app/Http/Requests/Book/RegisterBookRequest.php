<?php

declare(strict_types=1);

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

final class RegisterBookRequest extends FormRequest
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
            'libraryCode' => ['required', 'string'],
            'title' => ['required', 'string'],
            'isbn' => ['required', 'string'],
            'author' => ['present', 'string', 'nullable'],
            'publisher' => ['present', 'string', 'nullable'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'libraryCode' => '図書館識別コード',
            'title' => '題名',
            'isbn' => 'ISBN',
            'author' => '著者名',
            'publisher' => '出版社名',
        ];
    }
}
