<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttorneyStoreRequest extends FormRequest
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
            'attoneyID' => ['required', 'max:255', 'string'],
            'court_id' => ['required', 'exists:courts,id'],
            'fullname' => ['required', 'max:255', 'string'],
            'courtType' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'empType' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ];
    }
}
