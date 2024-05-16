<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    //

    public function index()
    {
        try {
            return response()->json([
                'status' => 'success',                               
                'data' => Evaluation::all()
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération des évaluations'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        if ($request->isJson()) {
            try {
                // Récupère les données du corps de la requête
                $data = $request->json()->all();
                // Crée une nouvelle evaluation
                $evaluation = Evaluation::create($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Evaluation créé'
                ], 201);
            } catch (ModelNotFoundException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Evaluation non trouvé'
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
        // Récupère l'évaluation par son id
        try {
            return response()->json([
                'status' => 'success',
                'data' => Evaluation::findOrFail($id)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Evaluation non trouvé'
            ], 404);
        }
    }


    public function update(Request $request, $id)
    {
        if ($request->isJson()) {
            try {
                // Récupère les données du corps de la requête
                $data = $request->json()->all();
                // Récupère l'évaluation par son id
                $evaluation = Evaluation::findOrFail($id);
                // Met à jour l'évaluation
                $evaluation->update($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Evaluation modifié'
                ], 200);
            } catch (ModelNotFoundException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Evaluation non trouvé'
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
            // Récupère l'évaluation par son id
            $evaluation = Evaluation::findOrFail($id);
            // Supprime l'évaluation
            $evaluation->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Evaluation supprimé'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Evaluation non trouvé'
            ], 404);
        }
    }

    public function showClient_Equipement($id)
    {
        try {
            // Récupère l'évaluation par son id
            $evaluation = Evaluation::findOrFail($id);
            // Récupère l'évaluation avec le client et l'équipement
            $evaluation->load('client', 'equipement');
            return response()->json([
                'status' => 'success',
                'data' => $evaluation
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Evaluation non trouvé'
            ], 404);
        }
    }
}
