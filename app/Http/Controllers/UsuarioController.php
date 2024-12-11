<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\NewAccessToken;


class UsuarioController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }

    $user = Auth::user();
    // $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Inicio de sesión exitoso',
        // 'token' => $token,
        'user' => $user,
    ]);
}

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'tipo_usuario' => 'required|string|in:cliente,trabajador',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_usuario' => $request->tipo_usuario
        ]);

        $data = [
            'message' => 'Usuario registrado exitosamente',
            'user' => $user
        ];

        return response()->json($data, 201);
    }

    public function profile(){
        return response()->json(Auth::user());
    }

    public function updateTipoUsuario(Request $request, $id)
    {
        // Valida los datos recibidos
        $request->validate([
            'tipo_usuario' => 'required|string|in:cliente,trabajador',
        ]);

        // Encuentra el usuario por ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Actualiza el tipo_usuario
        $user->tipo_usuario = $request->tipo_usuario;
        $user->save();

        return response()->json([
            'message' => 'El tipo de usuario se ha actualizado correctamente',
            'user' => $user,
        ], 200);
    }
}
