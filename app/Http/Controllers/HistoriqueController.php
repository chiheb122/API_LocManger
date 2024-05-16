<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historique;

class HistoriqueController extends Controller
{
    //
    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => Historique::all()
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération des historiques'
            ], 404);
        }
    }


    public function store(Request $request)
    {
        if ($request->isJson()) {
            try {
                // Récupère les données du corps de la requête
                $data = $request->json()->all();
                // Crée un nouveau historique
                $historique = Historique::create($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Historique créé'
                ], 201);
            } catch (ModelNotFoundException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Historique non trouvé'
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Le format de la requête est incorrect'
            ], 400);
        }
    }


    public function show($id)
    {
        // Récupère l'historique par son id
        try {
            return response()->json([
                'status' => 'success',
                'data' => Historique::findOrFail($id)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Historique non trouvé'
            ], 404);
        }
    }


    public function update(Request $request, $id)
    {
        if ($request->isJson()) {
            try {
                // Récupère les données du corps de la requête
                $data = $request->json()->all();
                // Met à jour l'historique
                $historique = Historique::findOrFail($id);
                $historique->update($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Historique mis à jour'
                ], 200);
            } catch (ModelNotFoundException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Historique non trouvé'
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Le format de la requête est incorrect'
            ], 400);
        }
    }


    public function destroy($id)
    {
        try {
            // Supprime l'historique
            Historique::findOrFail($id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Historique supprimé'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Historique non trouvé'
            ], 404);
        }
    }

    public function getHistoriqueByEquipement($id)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => Historique::where('hist_equId', $id)->get()
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Historique non trouvé'
            ], 404);
        }
    }
}
