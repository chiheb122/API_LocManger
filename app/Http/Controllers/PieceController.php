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
                $query = Piece::query();
                // Appliquer les filtres en fonction des paramètres de la requête
                $query->when(request()->has('nom'), function ($q) {
                    $q->where('pie_nom', 'like', '%' . request('nom') . '%');
                });

                $query->when(request()->has('quantite'), function ($q) {
                    $order = request('quantite') === 'asc' ? 'asc' : 'desc';
                    $q->orderBy('pie_quantite', $order);
                });

                $query->when(request()->has('stock'), function ($q) {
                    $q->where('pie_quantite', '=', 0)->orderBy('pie_quantite', 'desc');
                });

                $query->when(request()->has('sort'), function ($q) {
                    $order = request('sort') === 'asc' ? 'asc' : 'desc';
                    $q->orderBy('pie_dateEntree', $order);
                });

            return response()->json([               
                'status' => 'success',
                'data' => $query->get()
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
