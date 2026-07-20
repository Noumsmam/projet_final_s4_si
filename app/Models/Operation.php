<?php
namespace App\Models;
use CodeIgniter\Model;

    class Operation extends Model
    {
        protected $table = 'operation';
        protected $primaryKey = 'id';
        protected $allowedFields = ['type'];
    }