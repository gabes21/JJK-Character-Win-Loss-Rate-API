<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCharacterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if($method == 'PUT') {
            return [
                'name' => ['required', Rule::unique('characters', 'name')],
                'win' => ['required', 'integer'],
                'loss' => ['required', 'integer'],
                'alignment' => ['required', Rule::in(['G', 'N', 'E', 'g', 'n', 'e'])],
            ];
        } else {
            return [
                'name' => ['sometimes','required', Rule::unique('characters', 'name')],
                'win' => ['sometimes', 'required', 'integer'],
                'loss' => ['sometimes', 'required', 'integer'],
                'alignment' => ['sometimes', 'required', Rule::in(['G', 'N', 'E', 'g', 'n', 'e'])],
            ];
        }
        
    }
}
