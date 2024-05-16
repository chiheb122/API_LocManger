<?php
namespace App\Services;

use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementService{

public function index()
    {
        $paiements = Paiement::all();
        try {
            return response()->json([
                'status' => 'success',
                'paiements' => $paiements
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération des paiements'
            ], 500);
        }
    }


    public function getPaiementById($id)
    {
        $paiement = Paiement::find($id);
        if ($paiement) {
            return response()->json([
                'status' => 'success',
                'paiement' => $paiement
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Paiement non trouvé'
            ], 404);
        }
    }

    public function createPaiement(Request $request)
    {
        // Vérifie si la requête contient des données et qui respectent la structure de la table Paiement
        if ($request->isJson()) {
            // Récupère les données du corps de la requête
            $data = $request->json()->all();
            // Crée un nouveau paiement
            $paiement = Paiement::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Paiement ajouté avec succès'
            ], 200);
        } else {
            // La requête ne contient pas de données JSON
            return response()->json([
                'status' => 'error',
                'message' => 'Les données JSON sont requises',
                'error' => $request->json()->all()
            ], 400);

        }
    }

    public function updatePaiement($id, array $data)
    {
        $paiement = Paiement::find($id);
        if ($paiement) {
            $paiement->update($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Paiement modifié avec succès'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Paiement non trouvé'
            ], 404);
        }
    }


    public function deletePaiement($id)
    {
        $paiement = Paiement::find($id);
        if ($paiement) {
            $paiement->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Paiement supprimé avec succès'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Paiement non trouvé'
            ], 404);
        }
    }
}