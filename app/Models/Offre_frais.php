<?php
namespace App\Models;
use CodeIgniter\Model;

    class Offre_frais extends Model
    {
        protected $table = 'offre_frais';
        protected $primaryKey = 'id';
        protected $allowedFields = ['id_offre'];
    }