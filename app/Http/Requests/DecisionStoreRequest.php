<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DecisionStoreRequest extends FormRequest
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
            'mod_id' => ['required', 'exists:mods,id'],
            'case_hearing_id' => ['required', 'exists:case_hearings,id'],
            'empID' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'chargeType' => ['required', 'max:255', 'string'],
            'caseStartDate' => ['required', 'date'],
            'decisionDate' => ['required', 'date'],
            'decisionType' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ];
    }
}
