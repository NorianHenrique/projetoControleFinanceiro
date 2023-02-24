<?php

use App\Controllers\HomeController;
use App\Controllers\UsuarioController;
use App\Controllers\DespesaController; 
use App\Controllers\LoginController;

$app->get('/', HomeController::class.':index');
$app->get('/usuario', UsuarioController::class.':index');
$app->post('/cad-usuario', UsuarioController::class.':create');
$app->get('/despesa', DespesaController::class.':index');
$app->post('/cad-despesa', DespesaController::class.':create');
$app->get('/edit-despesa/{id}', DespesaController::class.':edit');
$app->post('/atualizar-despesa', DespesaController::class.':update');
$app->get('/excluir-despesa/{id}', DespesaController::class.':delete');
$app->get('/pagamento-despesa/{id}', DespesaController::class.':pagamento');

$app->get('/login', LoginController::class.':index');
$app->post('/entrar',LoginController::class.':logIn');
$app->get('/logout', LoginController::class.':logOut');