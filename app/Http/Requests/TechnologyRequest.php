<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnologyRequest extends FormRequest
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
            'name' => 'required|min:3|max:30'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.min' => 'Il campo nome deve contenere almeno 3 caratteri.',
            'name.max' => 'Il campo nome non può contenere più di 30 caratteri.'
        ];
    }
}
