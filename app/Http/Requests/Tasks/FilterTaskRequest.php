<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class FilterTaskRequest extends FormRequest
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
            'category_id' => 'exclude_if:category_id,null|integer',
            'start_date' => 'exclude_if:start_date,null|date',
            'end_date' => 'exclude_if:end_date,null|date|after:start_date',
            'status' => 'in:any,completed,not_completed',
            'upcoming' => 'nullable',
        ];
    }
}
