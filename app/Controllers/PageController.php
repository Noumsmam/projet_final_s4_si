<?php
namespace App\Controllers;
use App\Models\Client;
use App\Models\Prefixe;
use CodeIgniter\I18n\Time;

class PageController extends BaseController
{
    public function index($id) {
        $client = new Client();
        $clientInfo = $client->find($id);
        $prefixe = new Prefixe();
        $pref = $prefixe->find($clientInfo['id_prefixe']);
        $num = $pref + $clientInfo['num'];
        return view('home',['client' => $clientInfo,
        ''
        ]);
    }
}