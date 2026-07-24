<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:employes,email', 'max:255'],
            'entreprise_id' => ['required', 'exists:entreprises,id'],
            'ville_residence' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:conducteur,passager,les deux'],
            'password' => ['nullable', 'string', 'min:6'],
        ];
    }
}
