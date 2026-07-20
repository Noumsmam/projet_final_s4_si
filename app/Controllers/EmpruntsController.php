<?php

namespace App\Controllers;
use App\Models\Livres;
use App\Models\Emprunts;
use App\Models\Join;
use CodeIgniter\I18n\Time;

class EmpruntsController extends BaseController
{
    public function disponibles()
    {
        $livresModel = new Livres();
        $empruntsModel = new Emprunts();
        $empruntsActifs = $empruntsModel->where('date_retour', null)->findAll();
        $emprunteIds = [];
        if (!empty($empruntsActifs)) {
            foreach ($empruntsActifs as $e) {
                $emprunteIds[] = $e['livre_id'];
            }
        }
        if (!empty($emprunteIds)) {
            $livredisponible = $livresModel->whereNotIn('id', $emprunteIds)->findAll();
        } else {
            $livredisponible = $livresModel->findAll();
        }

        return view('empruntsDisponibles', ['livredisponible' => $livredisponible]);
    }

    public function emprunter($id)
    {
        $empruntsModel = new Emprunts();
        $empruntsModel->insert([
            'livre_id' => $id,
            'nom_emprunteur' => 'Emprunteur Anonyme',
            'date_emprunt' => Time::now()->toDateString(),
            'date_retour' => null
        ]);
        $livresModel = new Livres();
        $livresModel->update($id, ['statut' => 'prêté']);
        return redirect()->to('/emprunts');
    }

    public function pagerendre()
    {
        $joinModel = new Join();
        $emprunt = $joinModel->where('date_retour', null)->findAll();
        return view('rendreLivre', ['emprunt' => $emprunt]);
    }

    public function rendre($id)
    {
        $empruntsModel = new Emprunts();
        $empruntsModel->update($id, ['date_retour' => Time::now()->toDateString()]);
        $joinModel = new Join();
        $emprunt = $joinModel->where('emprunt_id', $id)->first();
        $livresModel = new Livres();
        $livresModel->update($emprunt['livre_id'], ['statut' => 'disponible']);
        return redirect()->to('/rendre');
    }
}
