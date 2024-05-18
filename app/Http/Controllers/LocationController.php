<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LocationService;

class LocationController extends Controller
{
    //
    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function index()
    {
        return $this->locationService->getAllLocations();
    }

    public function show($id)
    {
        return $this->locationService->getLocationById($id);
    }

    public function store(Request $request, LocationService $locationService)
    {
        return $locationService->createLocation($request);
    }

    public function update(Request $request, $id)
    {
        return $this->locationService->updateLocation($request, $id);
    }


    public function destroy($id)
    {
        return $this->locationService->deleteLocation($id);
    }

    public function getLocationsWithPaymentandUser()
    {
        return $this->locationService->getLocationsWithPaymentandUser();
    }
}
