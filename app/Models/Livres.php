<?php
namespace App\Models;
use CodeIgniter\Model;

    class Livres extends Model
    {
        protected $table = 'livres';
        protected $primaryKey = 'id';
        protected $allowedFields = ['titre', 'auteur', 'isbn', 'annee_publication', 'categorie', 'resume', 'couverture_filename', 'statut'];
    }