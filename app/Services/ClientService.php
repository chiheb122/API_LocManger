<?php

namespace App\Services;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientService
{
    public function getAllClients()
    {
        // Préparer la requête pour les filtres si nécessaire
        $query = Client::query();
        // filtre par nom si le paramètre est présent
        if (request()->has('nom')) {
            $query->where('cli_nom', 'like', '%' . request('nom') . '%');
        }
        // Appliquer le tri par nom si le paramètre est présent
        if (request()->has('nom')) {
            $order = request('nom') === 'asc' ? 'asc' : 'desc';
            $query->orderBy('cli_nom', $order);
        }


        // Récupère tous les clients
        $clients = $query->get();
        return response()->json([
            'status' => 'success',
            'clients' => $clients
        ], 200);
    }

    public function getClientById($id)
    {
        $client = Client::find($id);
        if ($client) {
            return response()->json([
                'status' => 'success',
                'client' => $client
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Client non trouvé'
            ], 404);
        }
    }

    public function createClient(Request $request)
    {
        // Vérifie si la requête contient des données
        if ($request->isJson()) {
            // Récupère les données du corps de la requête
            $data = $request->json()->all();
            // Crée un nouveau client
            $client = Client::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Client ajouté avec succès'
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
    

    public function updateClient($id, array $data)
    {
        $client = Client::find($id);
        if ($client) {
            $client->update($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Client modifié avec succès'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Client non trouvé'
            ], 404);
        }
    }

    public function deleteClient($id)
    {
        $client = Client::find($id);
        if ($client) {
            $client->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Client supprimé avec succès'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Client non trouvé'
            ], 404);
        }
    }


    // créer une méthode pour créer un client et l'associer à un utilisateur
    public function createClientForUser(Request $request)
    {
        // Vérifie si la requête contient des données
        if ($request->isJson()) {
            // Récupère les données du corps de la requête
            $data = $request->json()->all();
            // Crée un nouveau client
            $client = Client::create($data);
            // Enregistre le client
            $client->save();
            // crée l'user pour le client 
            $client->user()->create($data['user']);
             // Associer l'ID du client
            $client->user->Fk_cli_id = $client->cli_id;
            // Retourne une réponse JSON
            return response()->json([
                'status' => 'success',
                'message' => 'Client ajouté avec succès'
            ], 200);
        } else {
            // La requête ne contient pas de données JSON
            return response()->json([
                'status' => 'error',
                'message' => 'Les données JSON sont requises'
            ], 400);
        }
    }

    // une methode pour afficher seulement les détails du client authentifié
    public function getAuthenticatedClient()
    {
        // Récupère l'utilisateur authentifié
        $user = auth()->user();
        // Récupère le client associé à l'utilisateur
        $client = $user->client;
        // Retourne une réponse JSON
        return response()->json([
            'status' => 'success',
            'client' => $client
        ], 200);
    }
}
