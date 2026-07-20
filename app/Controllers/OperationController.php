<?php
namespace App\Controllers;
use App\Models\Client;
use App\Models\Offre;
use App\Models\Historique_transaction;
use App\Models\Offre_frais;
use App\Models\Frais;
use CodeIgniter\I18n\Time;

class OperationController extends BaseController
{
 	function depot($id,$montant){
        $client = new Client();
        $clientInf = $client->find($id);
        $solde = $clientInf['solde'] + $montant;
        $data=['solde' => $solde];
        $client->update($id,$data);
        $historique = new Historique_transaction();
        $dataHisto = [
            'id_client' => $id,
            'montant' => $montant,
            'id_operation' => 1
        ];
        $historique->save($data);
    }

    function retrait($id,$montant){
        $client = new Client();
        $clientInf = $client->find($id);
        $offre = new Offre();
        $idOffre = $offre->checkOffre($montant);
        $offreFrais = new Offre_frais();
        $frais = $offreFrais->getFrais($idOffre);
        $solde = $clientInf['solde'] - $montant - $frais;
        $data=['solde' => $solde];
        $client->update($id,$data);
        $historique = new Historique_transaction();
        $dataHisto = [
            'id_client' => $id,
            'montant' => $montant,
            'id_operation' => 2
        ];
        $historique->save($data);
    }
}