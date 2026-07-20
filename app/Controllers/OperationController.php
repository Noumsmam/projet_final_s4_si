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
        $offreFrais = new Offre_frais();
        $idOffre = $offre->checkOffre($montant);
        $frais = $offreFrais->getFrais($idOffre);
        if($client->checkSolde($id,$montant+$frais)){
            $solde = $clientInf['solde'] - $montant - $frais;
            $data=['solde' => $solde];
            $client->update($id,$data);
            $historique = new Historique_transaction();
            $dataHisto = [
                'id_client' => $id,
                'montant' => $montant,
                'id_operation' => 2
            ];
            $historique->save($dataHisto);
        } else {
            return view('home',['error' => 'fond insuffisant']);
        }
        return view('home');
    }

    function transfert($client2,$montant,$client1) {
        $client = new Client();
        $clientInf = $client->find($client1);
        $offre = new Offre();
        $offreFrais = new Offre_frais();
        $idOffre = $offre->checkOffre($montant);
        $frais = $offreFrais->getFrais($idOffre);
        if($client->checkSolde($client1,$montant+$frais)) {
            $solde1 = $clientInf['solde'] - $montant - $frais;
            $data1 = ['solde' => $solde1];
            $client->update($client1,$data1);
            $historique = new Historique_transaction();
            $dataHisto1 = [
                'id_client' => $client1,
                'montant' => $montant,
                'id_operation' => 3
            ];
            $historique->save($dataHisto1);

            $solde2 = $clientInf['solde'] + $montant;
            $data2 = ['solde' => $solde2];
            $client->update($client2,$data2);
            $historique = new Historique_transaction();
            $dataHisto2 = [
                'id_client' => $client2,
                'montant' => $montant,
                'id_operation' => 1
            ];
            $historique->save($dataHisto2);
        }
    }
}