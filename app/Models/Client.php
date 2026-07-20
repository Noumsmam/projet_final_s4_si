<?php
namespace App\Models;
use CodeIgniter\Model;

    class Client extends Model
    {
        protected $table = 'Client';
        protected $primaryKey = 'id';
        protected $allowedFields = ['id_prefixe','numero','solde','nom'];

        public function checkSolde($id,$montant) {
            $client = new Client();
            $clientInf = $client->find($id);
            $solde = $clientInf['solde'];
            $check = true;
            if($solde < $montant) {
                $check = false;
            }
            return $check;
        }

        public function getSituationClient() {
            $db = \Config\Database::connect();       
            $sql = "SELECT Client.id,Client.nom,Client.num,Client.solde 
                    Prefixe.num FROM Client JOIN prefixe ON Client.id_prefixe = prefixe.id";
            $query = $db->query($sql);
            $result = $query->getResultArray();
            return $result;
        }

    }