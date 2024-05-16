<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Promotion;

class PromotionController extends Controller
{
    //

    public function index()
    {
        try {
            $promotions = Promotion::all();
            return response()->json($promotions, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération des promotions'
            ], 500);
        }
    }


    public function store(Request $request)
    {
        if ($request->isJson()) {
            $data = $request->json()->all();
            $promotion = Promotion::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Promotion ajoutée avec succès'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Les données JSON sont requises',
                'error' => $request->json()->all()
            ], 400);
        }

    }


    public function show($id)
    {
        $promotion = Promotion::find($id);
        if ($promotion) {
            return response()->json($promotion, 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Promotion non trouvée'
            ], 404);
        }
    }


    public function update(Request $request, $id)
    {
      if ($request->isJson()) {
          $data = $request->json()->all();
         try {
            $promotion = Promotion::find($id);
            $promotion->update($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Promotion modifiée avec succès'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([ 'status' => 'error', 'message' => 'Erreur lors de la modification de la promotion'  ], 500);

        }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Les données JSON sont requises',
                'error' => $request->json()->all()
            ], 400);
        }

    }

    public function destroy($id)
    {
        $promotion = Promotion::find($id);
        if ($promotion) {
            $promotion->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Promotion supprimée avec succès'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Promotion non trouvée'
            ], 404);
        }
    }


}
