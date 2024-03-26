<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Vérification des identifiants pour l'utilisateur "admin"
        if ($credentials['email'] === 'admin@gmail.com' && $credentials['password'] === 'admin20') {
            return response()->json(['redirect' => 'admin.js'], 200);
        }

        // Tentative de connexion pour les autres utilisateurs
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json(['redirect' => 'other_page.js'], 200);
        } else {
            return response()->json(['message' => 'Adresse e-mail ou mot de passe incorrect'], 401);
        }
    }
}
