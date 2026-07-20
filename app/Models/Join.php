<?php
namespace App\Models;
use CodeIgniter\Model;

    class Join extends Model
    {
        protected $table = 'emprunts_livres';
        protected $primaryKey = 'emprunt_id';
        protected $allowedFields = ['emprunt_id', 'livre_id', 'titre', 'auteur', 'isbn', 'nom_emprunteur', 'date_emprunt', 'date_retour'];
    }