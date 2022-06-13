<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = new User([
            'names' => $request->names,
            'lastnames' => $request->lastnames,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->save();

        return response()->json([
            'message' => 'Usuario ingresado exitosamente',
            'user' => $user
        ], 200);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('email', $request->email)
                    ->first();
        
        if ($user == NULL || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => "Usuario no encontrado. Verifique sus credenciales."
            ], 401);
        }

        // $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ], 200);
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        return $user;
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Cierre de sesión exitoso'
        ], 200);
    }
}
