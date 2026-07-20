<?php
namespace App\Controllers;

use App\Models\Client;
use App\Models\Prefixe;

class ClientController extends BaseController
{
    public function create()
    {
        $prefixeModel = new Prefixe();
        $prefixes = $prefixeModel->findAll();

        return view('clients/form', [
            'client'   => null,
            'prefixes' => $prefixes,
            'action'   => '/gestion-clients/creer',
        ]);
    }

    public function store()
    {
        $clientModel = new Client();
        $data = [
            'nom'        => $this->request->getPost('nom'),
            'id_prefixe' => $this->request->getPost('id_prefixe'),
            'num'        => $this->request->getPost('num'),
            'solde'      => (float) $this->request->getPost('solde'),
        ];

        if (!$clientModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', 'Impossible de créer le client.');
        }

        return redirect()->to('/gestion-clients')->with('success', 'Client créé avec succès.');
    }

    public function edit($id)
    {
        $clientModel = new Client();
        $client = $clientModel->find($id);

        if (!$client) {
            return redirect()->to('/gestion-clients')->with('error', 'Client introuvable.');
        }

        $prefixeModel = new Prefixe();
        $prefixes = $prefixeModel->findAll();

        return view('clients/form', [
            'client'   => $client,
            'prefixes' => $prefixes,
            'action'   => '/gestion-clients/modifier/' . $id,
        ]);
    }

    public function update($id)
    {
        $clientModel = new Client();
        $client = $clientModel->find($id);

        if (!$client) {
            return redirect()->to('/gestion-clients')->with('error', 'Client introuvable.');
        }

        $data = [
            'nom'        => $this->request->getPost('nom'),
            'id_prefixe' => $this->request->getPost('id_prefixe'),
            'num'        => $this->request->getPost('num'),
            'solde'      => (float) $this->request->getPost('solde'),
        ];

        if (!$clientModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Impossible de modifier le client.');
        }

        return redirect()->to('/gestion-clients')->with('success', 'Client modifié avec succès.');
    }

    public function delete($id)
    {
        $clientModel = new Client();
        $client = $clientModel->find($id);

        if (!$client) {
            return redirect()->to('/gestion-clients')->with('error', 'Client introuvable.');
        }

        $clientModel->delete($id);

        return redirect()->to('/gestion-clients')->with('success', 'Client supprimé avec succès.');
    }
}
