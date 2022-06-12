<?php

namespace App\Http\Requests\Admin\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.request.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'entrence_year' => ['required', 'date'],
            'graduation_year' => ['required', 'date'],
            'cum' => ['required', 'numeric'],
            'graduation_date' => ['required', 'date'],
            'high_school_title' => ['required', 'string'],
            'birth_certificate' => ['required', 'string'],
            'paes' => ['required', 'string'],
            'health_certificate' => ['required', 'string'],
            'specialization_id' => ['required', 'string'],
            'degree_id' => ['required', 'string'],
            'applicant_id' => ['required', 'string'],
            
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
