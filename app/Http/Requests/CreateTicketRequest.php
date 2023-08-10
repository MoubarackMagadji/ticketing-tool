<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required','min:6'],
            'requester_dept_id' => ['required', 'integer', Rule::exists('depts', 'id')],
            'requester_user_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'subcategory_id' => ['required', 'integer', Rule::exists('subcategories', 'id')],
            'priority_id' => ['nullable', 'integer', Rule::exists('priorities', 'id')],
            'status_id' => ['nullable', 'integer', Rule::exists('statuses', 'id')],
        ];
    }
}
