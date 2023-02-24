<?php

namespace App\Controllers;

use App\Http\Controller;
use App\Models\Despesa;

class HomeController extends Controller
{   
    public function __construct() 
    {   
        parent::__construct();
        if (empty($_SESSION['id'])) {
            header('Location:'.BASE_URL.'/login');die();
        }
    }

    public function index()
    {   
        $despesa = new Despesa();
        $data['total_pago'] = $despesa->totalPago();
        $data['total_apagar'] = $despesa->totalApagar();
        $dia = $despesa->ultimaDia();
        $data['mesApagar'] = $despesa->mesApagar();
        $data['mesPago'] = $despesa->mesPago();

        $mes = [
            '1'=>'Janeiro',
            '2'=>'Fevereiro',
            '3'=>'Março',
            '4'=>'Abril',
            '5'=>'Maio',
            '6'=>'Junho',
            '7'=>'Julho',
            '8'=>'Agosto',
            '9'=>'Setembro',
            '10'=>'Outubro',
            '11'=>'Novembro',
            '12'=>'Dezembro'
        ];
        $data['mes'] = $mes;
        $dias = [];
        for ($i = 1; $i <= $dia; $i++) {
            array_push($dias,$i);
        }
        $data['dias'] = implode(",",$dias);
        
        $this->render('home',$data);
    }
}