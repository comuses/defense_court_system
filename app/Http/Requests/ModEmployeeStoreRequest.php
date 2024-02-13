<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModEmployeeStoreRequest extends FormRequest
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
            'EmpID' => ['required', 'max:255', 'string'],
            'rank' => ['required', 'max:255', 'string'],
            'fullName' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'empType' => ['required', 'max:255', 'string'],
        ];
    }
}
