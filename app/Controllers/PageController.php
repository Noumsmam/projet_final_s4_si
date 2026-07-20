<?php
namespace App\Controllers;
use App\Models\Client;
use App\Models\Prefixe;
use CodeIgniter\I18n\Time;

class PageController extends BaseController
{
    public function home() {
        $clientModel = new Client();
        $prefixeModel = new Prefixe();
        $client = $clientModel->find(session()->get('id'));
        $prefixe = $prefixeModel->find($client[0]['id_prefixe']);

        return view('home', ['client' => $client, 'prefixe' => $prefixe]);
    }

    // get situation mety mbola miampy le parametre azo fa reo no ananatsika 
    public function getSituationAllCompte() {
        $client = new Client();
        $listeClient = $client->getSituationClient();

        return view('clients/index', ['clients' => $listeClient]);
    }

    public function getAllTransfert() {
        
    }
}