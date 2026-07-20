<?php
namespace App\Models;
use CodeIgniter\Model;

    class Offre extends Model
    {
        protected $table = 'offre';
        protected $primaryKey = 'id';
        protected $allowedFields = ['montant_debut','montant_fin'];

        function checkOffre($montant) {
            $db = \Config\Database::connect();
            $sql = "SELECT id FROM offre WHERE offre.montant_debut < $montant
                    AND offre.montant_fin > $montant";
            $query = $db->query($sql);
            $result = $query->getResult();
            return $result;
        }
    }