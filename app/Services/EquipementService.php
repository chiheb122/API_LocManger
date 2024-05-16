<?php
namespace App\Services;

use App\Models\Equipement;
use Illuminate\Http\Request;

class EquipementService{
    public function getAllEquipements(){
         // Préparer la requête pour les filtres si nécessaire
            $query = Equipement::query();
       

            // filtre par nom si le paramètre est présent
            if (request()->has('nom')) {
                $query->where('equ_Nom', 'like', '%' . request('nom') . '%');
            }

            // Appliquer le tri par prix si le paramètre est présent
            if (request()->has('prix')) {
                $order = request('prix') === 'asc' ? 'asc' : 'desc';
                $query->orderBy('equ_PrixParJour', $order);
            }


        
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