<?php
namespace App\Models;
use CodeIgniter\Model;

    class Offre extends Model
    {
        protected $table = 'offre';
        protected $primaryKey = 'id';
        protected $allowedFields = ['montant_debut','montant_fin'];
    }