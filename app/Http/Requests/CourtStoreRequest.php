<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourtStoreRequest extends FormRequest
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
            'courtID' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'courtType' => ['required', 'max:255', 'string'],
            'Speciality' => ['required', 'max:255', 'string'],
            'Descryption' => ['required', 'max:255', 'string'],
        ];
    }
}
