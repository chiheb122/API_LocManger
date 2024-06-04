<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientService;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index()
    {
        return $this->clientService->getAllClients();
    }

    public function show($id)
    {
        return $this->clientService->getClientById($id);
    }

    public function store(Request $request, ClientService $clientService)
    {
        return $clientService->createClient($request);
    }
    

    public function update(Request $request, $id)
    {
        return $this->clientService->updateClient($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->clientService->deleteClient($id);
    }

    public function createClientForUser(Request $request)
    {
        return $this->clientService->createClientForUser($request);
    }

    // avoir les details d'un client authentifié
    public function getAuthenticatedClient()
    {
        return $this->clientService->getAuthenticatedClient();
    }
}
