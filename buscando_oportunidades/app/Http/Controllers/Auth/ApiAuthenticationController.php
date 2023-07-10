<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

/**
 * @group Autenticación
 *
 * APIs para autenticación de usuarios.
 */
class ApiAuthenticationController extends Controller
{
    /**
     * Login
     *
     * Generar un token de acceso para un usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required','string'],
        ]);

        // Check user exists
        $user = User::where('username', $credentials['username'])->first();
        if (!$user) {
            return response([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        // Check password
        $valid_credentials = Hash::check($credentials['password'], $user->password);

        if(!$valid_credentials) {
            return response([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => new  UsersResource($user),
            'token' => $token
        ];

        return response($response, 201);

    }

    /**
     * Logout
     *
     * Cerrar la sesión de un usuario. Elimina el token de acceso actual.
     *
     * @param Request $request
     * @return array
     */
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
