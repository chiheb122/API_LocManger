<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    //

    public function index()
    {
        try {
            $query = Service::query();
        // si le paramètre 'statut' est présent dans l'URL
        if (request()->has('statut')) {
            // filtre les services par statut
            $query->where('ser_statuts', request('statut'));
        }

        // si le paramètre 'nom' est présent dans l'URL
        if (request()->has('nom')) {
            // filtre les services par nom
            $query->where('ser_type', 'like', '%' . request('nom') . '%');
        }

        // récupère tous les services
            $services = $query->get();
            return response()->json([
                'status' => 'success',
                'data' => Service
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Service non trouvé'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        if ($request->isJson()) {
            try {
                // Récupère les données du corps de la requête
                $data = $request->json()->all();
                // Crée un nouveau service
                $service = Service::create($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Service créé'
                ], 201);
            } catch (ModelNotFoundException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Service non trouvé'
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
        // Récupère le service par son id
        try {
            return response()->json([
                'status' => 'success',
                'data' => Service::findOrFail($id)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Service non trouvé'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Récupère le service par son id
            $service = Service::find($id);
            // Récupère les données du corps de la requête
            $data = $request->json()->all();
            // Met à jour le service
            $service->update($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Service modifié'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la modification du service'
            ], 404);
        }
    }


    public function destroy($id)
    {
       try {
            // Récupère le service par son id
            $service = Service::find($id);
            // Supprime le service
            $service->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Service supprimé'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression du service'
            ], 404);
        }
    }


    public function Avecpiece($id)
    {
        $service = Service::find($id);
        if ($service) {
            $service->load('pieces');
            return response()->json([
                'status' => 'success',
                'data' => $service
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Service non trouvé'
            ], 404);
        }
       
    }


    public function AvecpieceWithFilter()
    {
        $query = Service::query();
        // si le paramètre 'statut' est présent dans l'URL
        if (request()->has('statut')) {
            // filtre les services par statut
            $query->where('ser_statuts', request('statut'));
        }

        // récupère tous les services
        $services = $query->get();

        if ($service) {
            $service->load('pieces');
            return response()->json([
                'status' => 'success',
                'data' => $service
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Service non trouvé'
            ], 404);
        }
       
    }




}
