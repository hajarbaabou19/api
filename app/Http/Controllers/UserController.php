<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User; // Assurez-vous d'importer le modèle User

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => ['required', 'string', 'regex:/^\+212[0-9]{9}$/'], // Numéro de téléphone commençant par +212 suivi de 9 chiffres
            'day' => 'required|integer|min:1|max:31', // Jour
            'month' => 'required|string', // Mois
            'year' => 'required|integer|min:1900|max:' . (date('Y') - 18), // Année (18 ans ou plus)
            'carte_nationale' => 'required|string|size:7', // Carte nationale de 12 caractères
            'password' => 'required|string|min:6', // Mot de passe
            'password_confirmation' => 'required|string|same:password', // Mot de passe confirmé
            'filiere' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Vérification du nombre d'inscriptions pour la filière spécifiée
                    $maxInscriptions = 30; // Maximum d'inscriptions par filière
                    $inscriptionsCount = User::where('filiere', $value)->count();

                    if ($inscriptionsCount >= $maxInscriptions) {
                        $fail("Le maximum d'inscriptions pour la filière $value est atteint.");
                    }
                },
            ],
            // Ajoutez d'autres règles de validation pour les autres champs ici
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Créez l'utilisateur ici

        // Retournez une réponse réussie si l'enregistrement est réussi
        return response()->json(['message' => 'Utilisateur enregistré avec succès.'], 201);
    }
}
