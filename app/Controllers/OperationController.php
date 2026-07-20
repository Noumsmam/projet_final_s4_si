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
 	function depot(){
        $id = session()->get('id');
        $montant = $this->request->getPost('montant');
        $client = new Client();
        $clientInf = $client->find($id);
        $solde = $clientInf[0]['solde'] + $montant;
        $client->where('id', $clientInf[0]['id'])->set(['solde' => $solde])->update();
        $historique = new Historique_transaction();
        $dataHisto = [
            'id_client' => $clientInf[0]['id'],
            'montant' => $montant,
            'id_operation' => 1
        ];
        $historique->insert($dataHisto);
        return redirect()->to('/home');
    }

    public function retrait()
    {
        $id = session()->get('id');
        $montant = (float) $this->request->getPost('montant');
        $clientModel = new Client();
        $clientInf = $clientModel->find($id);
        if (!$clientInf) {
            return redirect()->back()->with('error', 'Client introuvable.');
        }
        $offreModel = new Offre();
        $offre = $offreModel->checkOffre($montant); 
        $idOffre = is_array($offre) ? ($offre['id'] ?? $offre[0]['id'] ?? null) : $offre;
        $offreFraisModel = new Offre_frais();
        $fraisData = $offreFraisModel->getFrais($idOffre);
        $montantFrais = 0;
        if (!empty($fraisData)) {
            $montantFrais = (float) ($fraisData[0]['montant'] ?? $fraisData['montant'] ?? 0);
        }
        $coutTotal = $montant + $montantFrais;
        $soldeActuel = (float) $clientInf[0]['solde'];
        if ($soldeActuel < $coutTotal) {
            return redirect()->back()->with('error', 'Solde insuffisant pour effectuer ce retrait.');
        }
        $nouveauSolde = $soldeActuel - $coutTotal;
        $clientModel->update($clientInf[0]['id'], ['solde' => $nouveauSolde]);
        $historiqueModel = new Historique_transaction();
        $historiqueModel->save([
            'id_client'    => $clientInf[0]['id'],
            'montant'      => $montant,
            'id_operation' => 2
        ]);

        return redirect()->to('/home')->with('success', 'Retrait effectué avec succès.');
    }

    public function  transfert($client2,$montant){
        $id = session()->get('id');
        $client = new Client();
        $clientInf1 = $client->find($id);
        if (!$clientInf1) {
            return redirect()->back()->with('error', 'Client introuvable.');
        }
        $offreModel = new Offre();
        $offre = $offreModel->checkOffre($montant); 
        $idOffre = is_array($offre) ? ($offre['id'] ?? $offre[0]['id'] ?? null) : $offre;
        $offreFraisModel = new Offre_frais();
        $fraisData = $offreFraisModel->getFrais($idOffre);
        $montantFrais = 0;
        if (!empty($fraisData)) {
            $montantFrais = (float) ($fraisData[0]['montant'] ?? $fraisData['montant'] ?? 0);
        }
        $coutTotal = $montant + $montantFrais;
        $soldeActuel = (float) $clientInf1[0]['solde'];
        if ($soldeActuel < $coutTotal) {
            return redirect()->back()->with('error', 'Solde insuffisant pour effectuer ce retrait.');
        }
        $nouveauSolde = $soldeActuel - $coutTotal;
        $client->update($clientInf1[0]['id'], ['solde' => $nouveauSolde]);
        $historiqueModel = new Historique_transaction();
        $historiqueModel->save([
            'id_client'    => $clientInf1[0]['id'],
            'montant'      => $montant,
            'id_operation' => 3
        ]);

        $clientInf2 = $client->find($id);
        if (!$clientInf2) {
            return redirect()->back()->with('error', 'Client introuvable.');
        }
        
        $soldeActuel = (float) $clientInf2[0]['solde'];
        $nouveauSolde = $soldeActuel + $montant;
        $client->update($clientInf2[0]['id'], ['solde' => $nouveauSolde]);
        $historiqueModel = new Historique_transaction();
        $historiqueModel->save([
            'id_client'    => $clientInf2[0]['id'],
            'montant'      => $montant,
            'id_operation' => 3
        ]);
    } 
}