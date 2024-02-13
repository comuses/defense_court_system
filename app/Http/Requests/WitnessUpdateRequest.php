<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WitnessUpdateRequest extends FormRequest
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
            'witnessID' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'attorneyWitness' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
            'accusedWitness' => ['required', 'max:255', 'string'],
            'attoneyID' => ['required', 'max:255', 'string'],
            'caseChargedID' => ['required', 'max:255', 'string'],
        ];
    }
}
