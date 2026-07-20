<?php
namespace App\Models;
use CodeIgniter\Model;

    class Emprunts extends Model
    {
        protected $table = 'emprunts';
        protected $primaryKey = 'id';
        protected $allowedFields = ['livre_id', 'nom_emprunteur', 'date_emprunt', 'date_retour'];
    }