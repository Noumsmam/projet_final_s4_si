<?php
namespace App\Controllers;
use App\Models\Users;
use CodeIgniter\I18n\Time;

class AuthController extends BaseController
{
 	public function form()
 	{
 		return view('login');
 	}
 	public function login()
 	{
 		$model = new Users();
 		$email = $this->request->getPost('email');
 		$password = $this->request->getPost('password');
 		$user = $model->where('email', $email)->first();
 		if (!$user || $password !== $user['password']) {
 			return view('login', [
 				'erreur' => 'Email ou mot de passe incorrect'
 			]);
 		}
 		// Stocker uniquement les données non sensibles en session
 		session()->set('user', [
 			'id' => $user['id'],
 			'nom' => $user['nom'],
 			'email' => $user['email'],
 			'role' => $user['role'],
 			// 'admin' | 'bibliothecaire' | 'lecteur'
 		]);
 		return redirect()->to('/');
 	}

 	public function logout()
 	{
 		session()->destroy();
 		return redirect()->to('/login');
 	}
 }