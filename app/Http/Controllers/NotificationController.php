<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Notification_client;


class NotificationController extends Controller
{
    //
    public function index()
    {
        return Notification::all();
    }

    public function store(Request $request)
    {
        if ($request->isJson()) {
            // Récupère les données du corps de la requête
            $data = $request->json()->all();
            // Crée une nouvelle notification
            $notification = Notification::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Notification créé'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Le format de la requête est incorrect'
            ], 400);
        }
    }


    public function show($id)
    {
        // Récupère la notification par son id
       try {
            return response()->json([
                'status' => 'success',
                'data' => Notification::findOrFail($id)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Notification non trouvé'
            ], 404);
        }
    }




    public function destroy($id)
    {
        // Récupère la notification par son id
        $notification = Notification::find($id);
        // Supprime la notification
        $notification->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Notification supprimé'
        ], 200);
    }

    public function notificationsWithClient()
    {
        return response()->json([
            'status' => 'success',
            'data' => Notification::with('client')->get()
        ], 200);
    }

}
?>
