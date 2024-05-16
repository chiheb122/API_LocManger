<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;

class EmployeController extends Controller
{
    //
    public function index()
    {
       try {
            return response()->json([
                'status' => 'success',
                'data' => Employe::all()
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employe non trouvé'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        if ($request->isJson()) {
          try {
            // Récupère les données du corps de la requête
            $data = $request->json()->all();
            // Crée un nouvel employe
            $employe = Employe::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Employe créé'
            ], 201);
          } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employe non trouvé'
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
        // Récupère l'employe par son id
       try {
            return response()->json([
                'status' => 'success',
                'data' => Employe::findOrFail($id)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employe non trouvé'
            ], 404);
        }
    }


    public function update(Request $request, $id)
    {
        if ($request->isJson()) {
          try {
            // Récupère les données du corps de la requête
            $data = $request->json()->all();
            // Récupère l'employe par son id
            $employe = Employe::findOrFail($id);
            // Met à jour l'employe
            $employe->update($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Employe mis à jour'
            ], 200);
          } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employe non trouvé'
            ], 404);
          }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Le format de la requête est incorrect'
            ], 400);
        }
    }
    
}
