<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Devolve o usuário logado (ou null, se ninguém estiver logado)
    public function usuario(Request $request): JsonResponse
    {
        return response()->json([
            'usuario' => $request->user()?->only('name', 'email'),
        ]);
    }

    // Confere e-mail e senha no banco e inicia a sessão
    public function login(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Informe o e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'password.required' => 'Informe a senha.',
        ]);

        if (! Auth::attempt($dados)) {
            return response()->json(['message' => 'E-mail ou senha incorretos.'], 401);
        }

        $request->session()->regenerate();

        return response()->json([
            'usuario' => $request->user()->only('name', 'email'),
        ]);
    }

    // Encerra a sessão
    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['usuario' => null]);
    }
}
