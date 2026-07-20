<?php
namespace App\Models;
use CodeIgniter\Model;

    class Historique_transaction extends Model
    {
        protected $table = 'histo_transaction';
        protected $primaryKey = 'id';
        protected $allowedFields = ['id_client','montant','id_operation'];
    }