<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaiementService;

class PaiementController extends Controller
{
    //
   Protected $paiementService;

    public function __construct(PaiementService $paiementService)
    {
        $this->paiementService = $paiementService;
    }

    public function index()
    {
        return $this->paiementService->index();
    }

    public function show($id)
    {
        return $this->paiementService->getPaiementById($id);
    }

    public function store(Request $request)
    {
        return $this->paiementService->createPaiement($request);
    }

    public function update(Request $request, $id)
    {
        return $this->paiementService->updatePaiement($request, $id);
    }

    public function destroy($id)
    {
        return $this->paiementService->deletePaiement($id);
    }


}
