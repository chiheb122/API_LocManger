<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Piece;

class PieceController extends Controller
{
    //

    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => Piece::all()
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Piece non trouvé'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        if ($request->isJson()) {
            try {
                // Récupère les données du corps de la requête
                $data = $request->json()->all();
                // Crée une nouvelle piece
                $piece = Piece::create($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Piece créé'
                ], 201);
            } catch (ModelNotFoundException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Piece non trouvé'
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
        // Récupère la piece par son id
        try {
            return response()->json([
                'status' => 'success',
                'data' => Piece::findOrFail($id)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Piece non trouvé'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->isJson()) {
            try {
                // Récupère les données du corps de la requête
                $data = $request->json()->all();
                // Récupère la piece par son id
                $piece = Piece::findOrFail($id);
                // Met à jour la piece
                $piece->update($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Piece modifié'
                ], 200);
            } catch (ModelNotFoundException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Piece non trouvé'
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
            // Récupère la piece par son id
            $piece = Piece::findOrFail($id);
            // Supprime la piece
            $piece->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Piece supprimé'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Piece non trouvé ou déjà supprimé'
            ], 404);
        }
    }

}
