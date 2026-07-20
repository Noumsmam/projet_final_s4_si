<?php
namespace App\Models;
use CodeIgniter\Model;

    class Client extends Model
    {
        protected $table = 'Client';
        protected $primaryKey = 'id';
        protected $allowedFields = ['id_prefixe','numero','solde','nom'];

        function checkSolde($id,$montant) {
            $client = new Client();
            $clientInf = $client->find($id);
            $solde = $clientInf['solde'];
            $check = true;
            if($solde < $montant) {
                $check = false;
            }
            return $check;
        }
    }