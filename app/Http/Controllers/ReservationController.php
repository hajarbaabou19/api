<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'nom' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'date_reservation' => 'required|date',
            'description' => 'required|string',
            'salle' => 'required|string',
        ]);

        // Créer une nouvelle réservation
        $reservation = Reservation::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_reservation' => $request->date_reservation,
            'description' => $request->description,
            'salle' => $request->salle,
        ]);

        // Retourner une réponse réussie
        return response()->json(['message' => 'Réservation créée avec succès'], 201);
    }
}
