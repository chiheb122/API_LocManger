<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EquipementService;

class Equipement_Controller extends Controller
{
    //
    protected $equipementService;

    public function __construct(EquipementService $equipementService)
    {
        $this->equipementService = $equipementService;
    }

    public function index()
    {
        return $this->equipementService->getAllEquipements();
    }

    public function show($id)
    {
        return $this->equipementService->getEquipementById($id);
    }

    public function store(Request $request, EquipementService $equipementService)
    {
        return $equipementService->createEquipement($request);
    }

    public function update(Request $request, $id)
    {
        return $this->equipementService->updateEquipement($request, $id);
    }
    

    public function destroy($id)
    {
        return $this->equipementService->deleteEquipement($id);
    }





}
