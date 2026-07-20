<?php
namespace App\Models;

use CodeIgniter\Model;

class Offre_frais extends Model 
{
    protected $table = 'offre_frais';
    protected $allowedFields = ['id_offre', 'id_frais'];

    public function getFrais($id) 
    {
        // Si vous avez passé un tableau par erreur (ex: ['id' => 1]), on extrait la valeur
        if (is_array($id)) {
            $id = reset($id); // Récupère le premier élément du tableau
        }

        $db = \Config\Database::connect();

        // Correction de la syntaxe JOIN et utilisation des bindings (?)
        $sql = "SELECT f.montant 
                FROM frais f
                JOIN offre_frais of ON of.id_frais = f.id
                JOIN offre o ON o.id = of.id_offre 
                WHERE of.id_frais = ?";

        $query = $db->query($sql, [$id]);
        
        return $query->getResultArray();
    }
}