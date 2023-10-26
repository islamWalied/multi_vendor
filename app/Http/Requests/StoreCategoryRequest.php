<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => ["required","string","min:3","max:100","filter:php,laravel",
                /* this is how to make a custom validation */

/*                function($attributes,$value,$fails)
            {
                if (strtolower($value) == "laravel")
                {
                    $fails("this name is forbidden!");
                }
            },*/],
            'description' => 'nullable|string',
            'status' => 'in:active,archived',
            'image' => 'image',
            'parent_id' => 'nullable|numeric|exists:categories,id',

        ];
    }
}
