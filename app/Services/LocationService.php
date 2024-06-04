<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Paiement;
use App\Models\Client;

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


    // une fonction pour récupérer retourner le nombre de locations pour chaque utilisateur avec les informations de paiement
    public function getLocationsWithPaymentandUser(){
        // récupère toutes les locations avec les informations de paiement et de client en fonction des filtres 
        $query = Location::with('paiement', 'client');


        
        // filtre par nom de client
        if (request()->has('client')) {
            $query->whereHas('client', function ($query) {
                $query->where('cli_nom', 'like', '%' . request()->input('client') . '%');
            });
        }

        
        // filtre par alphabet ascendant de nom de client
        if (request()->has('sort')) {
            $order = request('sort') === 'asc' ? 'asc' : 'desc';
            $query->join('client', 'location.Fk_loc_cli', '=', 'client.cli_id')
                  ->orderBy('client.cli_nom', $order);
        }

        // récupère les locations
        $locations = $query->get();
    // Ajouter le nombre de locations de chaque client
    $locations->each(function ($location) {
        $location->client->locations_count = $location->client->locations()->count();
    });

       // Filtre par nombre de locations descendantes
       if (request()->has('locations_count')) {
        $order = request('locations_count') === 'asc' ? 'asc' : 'desc';
        $query->withCount('client')->orderBy('locations_count', $order);
    }
     
        return response()->json([
            'status' => 'success',
            'locations' => $locations
        ], 200);
    }
}
?>