<?php
namespace App\Services;

use App\Models\Equipement;
use Illuminate\Http\Request;

class EquipementService{
    public function getAllEquipements(){
         // Préparer la requête pour les filtres si nécessaire
            $query = Equipement::query();
       

        // Appliquer les filtres et les tris en fonction des paramètres de la requête
        $query->when(request()->has('nom'), function ($q) {
            $q->where('equ_Nom', 'like', '%' . request('nom') . '%');
        });

        $query->when(request()->has('prix'), function ($q) {
            $order = request('prix') === 'asc' ? 'asc' : 'desc';
            $q->orderBy('equ_PrixParJour', $order);
        });

        $query->when(request()->has('disponible'), function ($q) {
            $q->where('equ_StockDisponible', '>', 0)->orderBy('equ_Disponible', 'desc');
        });

        $query->when(request()->has('created_at'), function ($q) {
            $order = request('created_at') === 'asc' ? 'asc' : 'desc';
            $q->orderBy('created_at', $order);
        });
        
        $query->when(request()->has('type'), function ($q) {
            $q->orderBy('equ_Catégorie') === 'asc' ? 'asc' : 'desc';

        });
            


        
        // Récupère tous les équipements
        $equipements = $query->get();
         // Charger les relations 'location' pour chaque équipement
         $equipements->load('location');
        return response()->json([
            'status' => 'success',
            'equipements' => $equipements
        ], 200);
    }

    public function getEquipementById($id){
        $equipement = Equipement::find($id);
        if ($equipement) {
            return response()->json([
                'status' => 'success',
                'equipement' => $equipement
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Equipement non trouvé'
            ], 404);
        }
    }

    public function createEquipement(Request $request){
        // Vérifie si la requête contient des données
        if ($request->isJson()) {
            // Récupère les données du corps de la requête
            $data = $request->json()->all();
            // Crée un nouveau equipement
            $equipement = Equipement::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Equipement ajouté avec succès'
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


    public function updateEquipement(Request $request, $id){
        // Vérifie si la requête contient des données
        if ($request->isJson()) {
            // Récupère les données du corps de la requête
            $data = $request->json()->all();
            // Recherche l'équipement par son id
            $equipement = Equipement::find($id);
            if ($equipement) {
                // Met à jour les données de l'équipement
                $equipement->update($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Equipement modifié avec succès'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Equipement non trouvé'
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

    public function deleteEquipement($id){
        $equipement = Equipement::find($id);
        if ($equipement) {
            $equipement->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Equipement supprimé avec succès'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Equipement non trouvé'
            ], 404);
        }
    }




    
}