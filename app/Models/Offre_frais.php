<?php
namespace App\Models;

use CodeIgniter\Model;

class Offre_frais extends Model 
{
    protected $table = 'offre_frais';
    protected $allowedFields = ['id_offre', 'id_frais'];

    public function getFrais($id) 
    {
        if (is_array($id)) {
            $id = reset($id); 
        }
        $db = \Config\Database::connect();
        $sql = "SELECT f.montant 
                FROM frais f
                JOIN offre_frais of ON of.id_frais = f.id
                JOIN offre o ON o.id = of.id_offre 
            WHERE of.id_offre = ?";

        $query = $db->query($sql, [$id]);
        
        return $query->getResultArray();
    }
}