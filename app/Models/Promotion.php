<?php
namespace App\Models;
use CodeIgniter\Model;

    class Promotion extends Model
    {
        protected $table = 'promotion';
        protected $primaryKey = 'id';
        protected $allowedFields = ['id_prefixe','pourcentage'];
    }