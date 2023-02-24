<?php 

namespace App\Models;

trait Validation
{
    public function redirect(string $url):void 
    {   
        if ($url !== 'home') {
            header('Location:'.BASE_URL.'/'.$url);die();
        } 
        header('Location:'.BASE_URL);die();
    }

    public function destroySession():void
    {
        if (!empty($_SESSION['id'])) {
            session_destroy();
            $this->redirect('home');
        }
    }

    public function validarDados(array $campos): void
    {
        foreach ($campos as $key =>$campo) {

            if (empty($_POST[$key]) && $campo === 'required') {
                $_SESSION['tipo'] = 'danger';
                $_SESSION['campo'] = $key;
                $_SESSION['validar'] = true;
                break;
            }
        }

        $this->setDadosPost($campos);
    }

    public function flashMensagem(): array
    {
        $msg = [];
        if (!empty($_SESSION['tipo']) && $_SESSION['tipo'] === 'danger') {
            $campo = $_SESSION['campo'];
            $msg = ['tipo'=>'danger','mensagem'=>'Precisa preencher o campo '.$campo];
            $this->limparSession();
        }

        if (!empty($_SESSION['tipo']) && $_SESSION['tipo'] === 'success') {
            $msg = ['tipo'=>'success','mensagem'=>'cadastrado com sucesso!!!'];
            $this->limparSession();
        }

        return $msg;
    }

    private function limparSession(): void
    {
        unset($_SESSION['tipo']);
        unset($_SESSION['campo']);
    }

    public function validarTemError(): bool
    {
        if (!empty($_SESSION['validar'])) {
            unset($_SESSION['validar']);
            return true;
        }

        return false;
    }

    public function getDadosPost(): array
    {   
        $data = [
            'nome'=>'',
            'email'=>'',
            'login'=>'',
            'senha'=>'',
            'telefone'=>''
        ];

        foreach ($_SESSION as $key => $value) {
            if ($key !== 'id' && $key !== 'usuario_logado') {
                $data[$key] = $value;
                unset($_SESSION[$key]);
            }
        }

        return $data;
    }

    private function setDadosPost(array $campos): void
    {
        if (!empty($_SESSION['tipo']) && $_SESSION['tipo'] !== 'success') {
            foreach ($campos as $key => $campo) {
                $_SESSION[$key] = $_POST[$key];
            }
        }
    }
}