<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'author' => 'nullable|exists:users,id',
            'search' => 'nullable|string',
         ];
    }

    /**
     * Filter
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            'author' => $this->input('author'),
            'search' => $this->input('search'),
        ];
    }
}
