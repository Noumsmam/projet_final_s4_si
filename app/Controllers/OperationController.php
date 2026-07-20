<?php
namespace App\Controllers;
use App\Models\Client;
use App\Models\Offre;
use App\Models\Historique_transaction;
use App\Models\Offre_frais;
use App\Models\Prefixe;
use App\Models\Frais;
use CodeIgniter\I18n\Time;

class OperationController extends BaseController
{
    private function getClientRow($client)
    {
        if (is_array($client) && array_key_exists(0, $client) && is_array($client[0])) {
            return $client[0];
        }

        return $client;
    }

    private function getOfferId($offre): ?int
    {
        if (is_object($offre) && isset($offre->id)) {
            return (int) $offre->id;
        }

        if (is_array($offre)) {
            if (isset($offre['id'])) {
                return (int) $offre['id'];
            }

            if (isset($offre[0]) && is_object($offre[0]) && isset($offre[0]->id)) {
                return (int) $offre[0]->id;
            }

            if (isset($offre[0]) && is_array($offre[0]) && isset($offre[0]['id'])) {
                return (int) $offre[0]['id'];
            }
        }

        return null;
    }

    function pageDepot(){
        $clientModel = new Client();
        $prefixeModel = new Prefixe();
        $client = $this->getClientRow($clientModel->find(session()->get('id')));
        $prefixe = $prefixeModel->find($client['id_prefixe']);

        return view('depot', ['client' => [$client], 'prefixe' => $prefixe]);
    }

    function pageRetrait(){
        $clientModel = new Client();
        $prefixeModel = new Prefixe();
        $client = $this->getClientRow($clientModel->find(session()->get('id')));
        $prefixe = $prefixeModel->find($client['id_prefixe']);

        return view('retrait', ['client' => [$client], 'prefixe' => $prefixe]);
    }

    function depot(){
        $id = session()->get('id');
        $montant = $this->request->getPost('montant');
        $client = new Client();
        $clientInf = $this->getClientRow($client->find($id));
        $solde = $clientInf['solde'] + $montant;
        $client->where('id', $clientInf['id'])->set(['solde' => $solde])->update();
        $historique = new Historique_transaction();
        $dataHisto = [
            'id_client' => $clientInf['id'],
            'montant' => $montant,
            'id_operation' => 1
        ];
        $historique->insert($dataHisto);
        return redirect()->to('/depot');
    }

    public function retrait()
    {
        $id = session()->get('id');
        $montant = (float) $this->request->getPost('montant');
        $clientModel = new Client();
        $clientInf = $this->getClientRow($clientModel->find($id));
        if (!$clientInf) {
            return redirect()->back()->with('error', 'Client introuvable.');
        }
        $offreModel = new Offre();
        $offre = $offreModel->checkOffre($montant); 
        $idOffre = $this->getOfferId($offre);
        $offreFraisModel = new Offre_frais();
        $fraisData = $offreFraisModel->getFrais($idOffre);
        $montantFrais = 0;
        if (!empty($fraisData)) {
            $montantFrais = (float) ($fraisData[0]['montant'] ?? $fraisData['montant'] ?? 0);
        }
        $coutTotal = $montant + $montantFrais;
        $soldeActuel = (float) $clientInf['solde'];
        if ($soldeActuel < $coutTotal) {
            return redirect()->back()->with('error', 'Solde insuffisant pour effectuer ce retrait.');
        }
        $nouveauSolde = $soldeActuel - $coutTotal;
        $clientModel->update($clientInf['id'], ['solde' => $nouveauSolde]);
        $historiqueModel = new Historique_transaction();
        $historiqueModel->save([
            'id_client'    => $clientInf['id'],
            'montant'      => $montant,
            'id_operation' => 2
        ]);

        return redirect()->to('/retrait')->with('success', 'Retrait effectué avec succès.');
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
        $idOffre = $this->getOfferId($offre);
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