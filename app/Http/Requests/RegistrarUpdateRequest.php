<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'MIDNumber' => ['required', 'max:255', 'string'],
            'Rank' => ['required', 'max:255', 'string'],
            'Name' => ['required', 'max:255', 'string'],
            'fieldType' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'city' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'court_id' => ['required', 'exists:courts,id'],
        ];
    }
}
