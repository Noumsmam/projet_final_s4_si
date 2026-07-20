<?php
namespace App\Models;
use CodeIgniter\Model;

    class Compte_operateur extends Model
    {
        protected $table = 'compte_operateur';
        protected $primaryKey = 'id';
        protected $allowedFields = ['id_prefixe','solde'];
    }