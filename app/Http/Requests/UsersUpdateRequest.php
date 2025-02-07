<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersUpdateRequest extends FormRequest
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
            'fullname' => 'required',
            'role_id' => 'required',
        ];
    }    

    public function messages()
    {
        return [
            'fullname.required' => 'El campo nombre es obligatorio.',
            'role_id.required' => 'Debe seleccionar rol.',
        ];
    }
}
