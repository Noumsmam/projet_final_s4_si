<?php
namespace App\Models;
use CodeIgniter\Model;

    class Users extends Model
    {
        protected $table = 'utilisateurs';
        protected $primaryKey = 'id';
        protected $allowedFields = ['nom', 'email', 'role', 'password'];
    }