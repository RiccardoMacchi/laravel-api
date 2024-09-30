<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'git_link' => ['required', 'string', 'min:5', 'max:255'],
            'lenguages' => ['required', 'string', 'min:2', 'max:255'],
            'date' => ['required', 'date'],
            'description' => ['required', 'string','min:10'],
            'type_id' => ['required'],
            'img_path' => ['image','mimes:png,jpg','max:5120']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.string' => 'Il titolo deve essere una stringa.',
            'title.min' => 'Il titolo deve avere almeno 5 carattere.',
            'title.max' => 'Il titolo non può superare i 100 caratteri.',

            'git_link.required' => 'Il link Git è obbligatorio.',
            'git_link.string' => 'Il link Git deve essere una stringa.',
            'git_link.min' => 'Il link Git deve avere almeno 5 carattere.',
            'git_link.max' => 'Il link Git non può superare i 255 caratteri.',

            'lenguages.required' => 'Il campo linguaggi è obbligatorio.',
            'lenguages.string' => 'Il campo linguaggi deve essere una stringa.',
            'lenguages.min' => 'Il campo linguaggi deve avere almeno 2 carattere.',
            'lenguages.max' => 'Il campo linguaggi non può superare i 255 caratteri.',

            'date.required' => 'La data è obbligatoria.',
            'date.date' => 'Il valore fornito deve essere una data valida.',

            'description.required' => 'La descrizione è obbligatoria.',
            'description.string' => 'La descrizione deve essere una stringa.',
            'description.min' => 'La descrizione deve avere almeno 10 carattere.',

            'type_id.required' => 'Il tipo è obbligatorio',

            'img_path.image' => 'Il file deve essere un\'immagine.',
            'img_path.mimes' => 'Il file deve essere un\'immagine di tipo :values',
            'img_path.max' => 'L\'immagine non può essere più grande di 5 MB.',
        ];
    }
}
