<?php

namespace App\Http\Requests\Api\V1\Public;
use Illuminate\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:30',
            'mobile' => 'required|unique:users,mobile|string|min:8|max:15',
            'company' => 'required'
        ];
    }
}
