<?php

namespace App\Controllers;
use App\Models\Livres;
use App\Models\Join;

class LivresController extends BaseController
{
    public function liste() 
    {
        $livres=new Livres();
        $Livres=$livres->findAll();
        return view('listeLivres', ['Livres'=>$Livres]); 
    }

    public function details($id) 
    {
        $livres=new Livres();
        $livre=$livres->find($id);
        $join=new Join();
        $dernierEmprunt=$join->where('livre_id', $id)->orderBy('date_emprunt', 'DESC')->first();
        return view('detailsLivre', ['livre'=>$livre, 'dernierEmprunt'=>$dernierEmprunt]);
    }

    public function ajouter() 
    {
        return view('ajouterLivre');
    }

    public function creer(){
        $livres = new Livres();
        $data = $this->request->getPost();
        $file = $this->request->getFile('couverture_filename');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadsPath = FCPATH . 'uploads';
            if (!is_dir($uploadsPath)) {
                mkdir($uploadsPath, 0755, true);
            }
            $newName = $file->getRandomName();
            $file->move($uploadsPath, $newName);
            $data['couverture_filename'] = $newName;
        }

        $livres->insert($data);
        return redirect()->to('/');
    }

    public function supprimer($id){
        $livres=new Livres();
        $livres->delete($id);
        return redirect()->to('/');
    }

    public function recherche(){
        $livres = new Livres();
        $categories = $livres->select('categorie')
                              ->distinct()
                              ->orderBy('categorie')
                              ->findColumn('categorie');

        return view('rechercheLivre', ['categories' => $categories]);
    }

    public function rechercher(){
        $query = $this->request->getPost('query');
        $categorie = $this->request->getPost('categorie');
        $livres = new Livres();
        $builder = $livres->builder();
        if (!empty($query)) {
            $builder->like('titre', $query);
        }
        if (!empty($categorie)) {
            $builder->where('categorie', $categorie);
        }
        $resultats = $builder->get()->getResultArray();
        return view('resultatsRecherche', ['livres' => $resultats]);
    }
}
