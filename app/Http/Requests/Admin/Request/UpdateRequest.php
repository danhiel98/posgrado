<?php

namespace App\Http\Requests\Admin\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.request.edit', $this->request);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'entrence_year' => ['sometimes', 'date'],
            'graduation_year' => ['sometimes', 'date'],
            'cum' => ['sometimes', 'numeric'],
            'graduation_date' => ['sometimes', 'date'],
            'high_school_title' => ['sometimes', 'string'],
            'birth_certificate' => ['sometimes', 'string'],
            'paes' => ['sometimes', 'string'],
            'health_certificate' => ['sometimes', 'string'],
            'specialization_id' => ['sometimes', 'string'],
            'degree_id' => ['sometimes', 'string'],
            'applicant_id' => ['sometimes', 'string'],
            
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}