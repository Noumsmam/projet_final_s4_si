<?php
namespace App\Models;
use CodeIgniter\Model;

    class Historique_transaction extends Model
    {
        protected $table = 'histo_transcaction';
        protected $primaryKey = 'id';
        protected $allowedFields = ['id_client','montant','id_operation'];

        public function getHistoriqueByClient($id) {
            $db = \Config\Database::connect();
            $sql = "SELECT histo_transcaction.id,histo_transcaction.montant,operation.type 
                    FROM histo_transcaction JOIN operation ON operation.id = histo_transcaction.id_operation
                    JOIN Client ON Client.id = histo_transcaction.id_client WHERE histo_transcaction.id_client = ?";
            $query = $db->query($sql,[$id]);
            return $query->getResultArray();
        }
    }