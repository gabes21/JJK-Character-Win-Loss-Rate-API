<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreCharacterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.name' => ['required', Rule::unique('characters', 'name')],
            '*.win' => ['required', 'integer'],
            '*.loss' => ['required', 'integer'],
            '*.alignment' => ['required', Rule::in(['G', 'N', 'E', 'g', 'n', 'e'])],
        ];
    }
}
