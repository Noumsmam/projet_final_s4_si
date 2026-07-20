<?php
namespace App\Controllers;
use App\Models\Client;
use App\Models\Prefixe;
use CodeIgniter\I18n\Time;

class AuthController extends BaseController
{
 	public function form()
 	{
 		return view('login');
 	}

	public function verifier($numero)
	{
		if (strlen($numero) < 4) {
			return null;
		}

		$prefixe = substr($numero, 0, 3);
		$num = substr($numero, 3);

		$prefixeModel = new Prefixe();
		$prefixeData = $prefixeModel->where('num', $prefixe)->first();
		if (!$prefixeData) {
			return null;
		}

		$model = new Client();
		return $model->where('num', $num)->where('id_prefixe', $prefixeData['id'])->first();
	}

 	public function login()
 	{
 		$numero = $this->request->getPost('numero');
		$client = $this->verifier($numero);

		if (!$client) {
			return redirect()->back()->with('error', 'Numéro de téléphone ou préfixe invalide.');
		}

 		session()->set('client', [
 			'id' => $client['id'],
 			'id_prefixe' => $client['id_prefixe'],
 			'num' => $client['num'],
 			'solde' => $client['solde'],
 			'nom' => $client['nom'],
 		]);

 		return redirect()->to('/home');
 	}

 	public function logout()
 	{
 		session()->destroy();
 		return redirect()->to('/');
 	}
 }