<?php
namespace App\Models;
use CodeIgniter\Model;

    class Client extends Model
    {
        protected $table = 'Client';
        protected $primaryKey = 'id';
        protected $allowedFields = ['id_prefixe','num','solde','nom'];
<<<<<<< HEAD
=======

        function getNumById($id) {
            
        }
>>>>>>> nomena
    }