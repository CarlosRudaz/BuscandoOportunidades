<?php

namespace App\Http\Requests\Users;

use App\Enums\TiposUsuarios;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrarUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $min_role_required = TiposUsuarios::ADMINISTRADOR;
        /** @var User $user */
        $user = \Auth::user();
        $user_rol_val = $user->rol->value;

        if($user_rol_val >= $min_role_required && $user_rol_val >= $this->rol) return  true;

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = \Auth::user();
        return [
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|max:250|unique:users',
            'username' => ['required', Rule::unique('users')->ignore($user->username), 'string', 'max:255'],
            'password' => 'required|string|min:6|max:100|confirmed',
            'rol' => ['required', Rule::in(TiposUsuarios::$REGISTRABLE)]
        ];
    }
}
