<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required',
            'username' => ['required', Rule::unique('users', 'username')->ignore($this->user)],
            'email' => ['nullable', 'email', Rule::unique('users','email')->ignore($this->user)],
            'staffID' => ['required', Rule::unique('users', 'staffID')->ignore($this->user) ],
            'dept_id' => ['required', Rule::exists('depts', 'id')],
            'level' => 'required|integer|min:1|max:5',
        ];
    }
}
