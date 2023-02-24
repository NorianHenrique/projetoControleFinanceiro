<?php 

namespace App\Models;

use App\Database\MySQL;

class Usuario
{   
    use Validation;

    public function login(string $login,string $senha):string 
    {
        $sql = "SELECT * FROM usuario WHERE `login` = :login";
        $query = MySQL::getInstancia()->prepare($sql);
        $query->bindValue(':login',$login);
        $query->execute();
        if ($query->rowCount() > 0) {
            $dados = $query->fetch(\PDO::FETCH_OBJ);
            $this->verificarSenha($senha,$dados);
        } 
            
        return "Usuário e/ou senha invalido";
    }

    private function verificarSenha(string $senha, object $data):void 
    {
        if (password_verify($senha,$data->senha)) {
            $_SESSION['id'] = $data->id;
            $_SESSION['usuario_logado'] = $data->login;
            $this->redirect('home');
        }
    }

    public function adicionarUsuario(array $campos): void
    {  
        $sql = "INSERT INTO usuario (nome_completo,email,login,senha,telefone)
        VALUES (:nome,:email,:login,:senha,:telefone)";
        $query = MySQL::getInstancia()->prepare($sql);
        $query->bindValue(':nome',$campos['nome']);
        $query->bindValue(':email',$campos['email']);
        $query->bindValue(':login',$campos['login']);
        $query->bindValue(':senha',$this->hashSenha($campos['senha']));
        $query->bindValue(':telefone',$campos['telefone']);
        
        if ($query->execute()) {
            $_SESSION['tipo'] = 'success';
        }
    }

    private function hashSenha(string $hash): string
    {
        return password_hash($hash,PASSWORD_DEFAULT);
    }
}