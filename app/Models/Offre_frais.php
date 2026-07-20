<?php
namespace App\Models;
use CodeIgniter\Model;

    class Offre_frais extends Model
    {
        protected $table = 'offre_frais';
        // protected $primaryKey = 'id';
        protected $allowedFields = ['id_offre','id_frais'];

        function getFrais($id) {
            $db = $db = \Config\Database::connect();
            $sql = "SELECT frais.montant FROM frais JOIN offre_frais.id_frais = frais.id
                    JOIN offre On offre.id = offre_frais.id_offre WHERE offre_frais.id_frais=$id";
            $query = $db->query($sql);
            $resutl = $query->getResultArray();
            return $result;        
        }
    }