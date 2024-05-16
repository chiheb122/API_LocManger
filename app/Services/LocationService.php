<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationService{
    public function getAllLocations(){
        $locations = Location::all();
        return response()->json([
            'status' => 'success',
            'locations' => $locations
        ], 200);
    }

    public function getLocationById($id){
        $location = Location::find($id);
        if ($location) {
            return response()->json([
                'status' => 'success',
                'location' => $location
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Location non trouvée'
            ], 404);
        }
    }

    public function createLocation(Request $request){
        // Vérifie si la requête contient des données
        if ($request->isJson()) {
            // Récupère les données du corps de la requête
            $data = $request->json()->all();
            // Crée une nouvelle location
            $location = Location::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Location ajoutée avec succès'
            ], 200);
        } else {
            // La requête ne contient pas de données JSON
            return response()->json([
                'status' => 'error',
                'message' => 'Les données JSON sont requises',
                'error' => $request->json()->all()
                // voir la réponse de l'erreur exacte
                
            ], 400);
        }
    }

    public function updateLocation(Request $request, $id){
        // Vérifie si la requête contient des données
        if ($request->isJson()) {
            // Récupère les données du corps de la requête
            $data = $request->json()->all();
            // Recherche la location par son id
            $location = Location::find($id);
            if ($location) {
                // Met à jour les données de la location
                $location->update($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Location modifiée avec succès'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Location non trouvée'
                ], 404);
            }
        } else {
            // La requête ne contient pas de données JSON
            return response()->json([
                'status' => 'error',
                'message' => 'Les données JSON sont requises',
                'error' => $request->json()->all()
                // voir la réponse de l'erreur exacte
            ], 400);
        }
    }

    public function deleteLocation($id){
        $location = Location::find($id

        );
        if ($location) {
            $location->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Location supprimée avec succès'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Location non trouvée'
            ], 404);
        }
    }
}
?>