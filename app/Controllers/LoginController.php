<?php

namespace App\Controllers;

use App\Http\Controller;
use App\Models\Usuario;

class LoginController extends Controller
{   
    public function index()
    {  
        $this->render('login');
    }

    public function logIn()
    {   
        $data = [];
        $login = filter_input(INPUT_POST,'login');
        $senha = filter_input(INPUT_POST,'senha');
        
        $usuario = new Usuario();
        $data['msg'] = $usuario->login($login,$senha);

        $this->render('login',$data);
    }

    public function logOut()
    {
        $this->destroySession();
    }
}