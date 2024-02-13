<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaseChargeStoreRequest extends FormRequest
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
            'mod_employee_id' => ['required', 'exists:mod_employees,id'],
            'mod_id' => ['required', 'exists:mods,id'],
            'rank' => ['required', 'max:255', 'string'],
            'fullName' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'crimeType' => ['required', 'max:255', 'string'],
            'crimeDate' => ['required', 'date'],
            'chargeDate' => ['required', 'date'],
            'registrar_id' => ['required', 'exists:registrars,id'],
        ];
    }
}
