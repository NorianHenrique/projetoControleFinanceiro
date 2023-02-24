<?php

namespace App\Models;

use App\Database\MySQL;

class Despesa 
{
    public function totalPago()
    {   
        $sql = "SELECT LAST_DAY(CURRENT_DATE()) AS data_final";
        $query = MySQL::getInstancia()->prepare($sql);
        $query->execute();
        $data_final = $query->fetch();

        $sql2 = "SELECT SUM(valor) AS total FROM despesa WHERE data_pagamento 
        BETWEEN :data_inicio AND :data_final AND situacao = :situacao AND id_usuario = :id";
        $query = MySQL::getInstancia()->prepare($sql2);
        $query->bindValue(':data_inicio',date('Y-m-01'));
        $query->bindValue(':data_final',$data_final['data_final']);
        $query->bindValue(':situacao','pago');
        $query->bindValue(':id',$_SESSION['id']);
        $query->execute();

        if ($query->rowCount() > 0) {
            return $query->fetch();
        }
    }

    public function totalApagar()
    {   
        $sql = "SELECT LAST_DAY(CURRENT_DATE()) AS data_final";
        $query = MySQL::getInstancia()->prepare($sql);
        $query->execute();
        $data_final = $query->fetch();

        $sql2 = "SELECT SUM(valor) AS total FROM despesa WHERE vencimento 
        BETWEEN :data_inicio AND :data_final AND situacao = :situacao AND id_usuario = :id";
        $query = MySQL::getInstancia()->prepare($sql2);
        $query->bindValue(':data_inicio',date('Y-m-01'));
        $query->bindValue(':data_final',$data_final['data_final']);
        $query->bindValue(':situacao','apagar');
        $query->bindValue(':id',$_SESSION['id']);
        $query->execute();

        if ($query->rowCount() > 0) {
            return $query->fetch();
        }
    }

    public function formaDePagamento()
    {   
        $sql = "SELECT * FROM pagamento";
        $query = MySQL::getInstancia()->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0) {
            return $query->fetchAll();
        } else {
            return;
        }
    }

    public function adicionarDespesa($descricao,$dataVencimento,$valor,$situacao,$pagamento)
    {   
        //desconto em dinheiro 10% e debito 5%
        $desconto = 0;
        $aux = 0;
        if ($pagamento == 'Dinheiro') {
            $aux = 10/100;
            $desconto = $valor * $aux;
            $valor -= $desconto;
        } else if ($pagamento == 'Debito') {
            $aux = 5/100;
            $desconto = $valor * $aux;
            $valor -= $desconto;
        } else if ($pagamento == 'Credito') {
            $valor;
        }

        if ($situacao == 'Apagar') {
            $sql = "INSERT INTO despesa (descricao,vencimento,valor,situacao,pagamento,desconto,id_usuario)
            VALUES ('$descricao','$dataVencimento','$valor','$situacao','$pagamento','$desconto','$_SESSION[id]')";
            $query = MySQL::getInstancia()->prepare($sql);
            $query->execute();
            $id = MySQL::getInstancia()->lastInsertId();
            if ($id) {
                return true;
            } else {
                return false;
            }
        } else {
            $sql = "INSERT INTO despesa (descricao,vencimento,valor,situacao,pagamento,desconto,id_usuario,data_pagamento)
            VALUES ('$descricao','$dataVencimento','$valor','$situacao','$pagamento','$desconto','$_SESSION[id]',NOW())";
            $query = MySQL::getInstancia()->prepare($sql);
            $query->execute();
            $id = MySQL::getInstancia()->lastInsertId();
            if ($id) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function todasDespesas()
    {
        $sql = "SELECT * FROM despesa 
        WHERE id_usuario = $_SESSION[id]";
        $query = MySQL::getInstancia()->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0) {
            return $query->fetchAll();
        } else {
            return;
        }
    }

    public function unicaDespesa($id)
    {   
        $sql = "SELECT * FROM despesa WHERE id_usuario = $_SESSION[id] AND id = $id";
        $query = MySQL::getInstancia()->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0) {
            return $query->fetch();
        } else {
            return;
        }
    }

    public function atualizarDespesa($descricao,$dataVencimento,$valor,$situacao,$pagamento,$id)
    {   
        //desconto em dinheiro 10% e debito 5%
        $desconto = 0;
        $aux = 0;
        if ($pagamento == 'Dinheiro') {
            $aux = 10/100;
            $desconto = $valor * $aux;
            $valor -= $desconto;
        } else if ($pagamento == 'Debito') {
            $aux = 5/100;
            $desconto = $valor * $aux;
            $valor -= $desconto;
        } else if ($pagamento == 'Credito') {
            $valor;
        }

        if ($situacao == 'Apagar') {
            $sql = "UPDATE despesa SET descricao = '$descricao', valor = '$valor', vencimento = '$dataVencimento', 
            situacao = '$situacao', pagamento = '$pagamento' , desconto = '$desconto' WHERE id = '$id' AND id_usuario = $_SESSION[id]";
            $query = MySQL::getInstancia()->prepare($sql);
            return $query->execute();
        } else {
            $sql = "UPDATE despesa SET descricao = '$descricao', valor = '$valor', vencimento = '$dataVencimento',
            situacao = '$situacao', pagamento = '$pagamento', data_pagamento = NOW() , desconto = '$desconto' WHERE id = '$id' AND id_usuario = $_SESSION[id]";
            $query = MySQL::getInstancia()->prepare($sql);
            return $query->execute();
        }
    }

    public function pagamento($id) 
    {
        $sql = "UPDATE despesa SET data_pagamento = NOW(), situacao = 'Pago' WHERE id = '$id' AND id_usuario = $_SESSION[id]";
        $query = MySQL::getInstancia()->prepare($sql);
        return $query->execute();
    }

    public function excluirDespesa($id)
    {
        $sql = "DELETE FROM despesa WHERE id = $id AND id_usuario = $_SESSION[id]";
        $query = MySQL::getInstancia()->prepare($sql);
        return $query->execute();
    }

    public function ultimaDia()
    {   
        $sql = "SELECT LAST_DAY(CURRENT_DATE()) AS data_final";
        $query = MySQL::getInstancia()->prepare($sql);
        $query->execute();
        $data_final = $query->fetch();
        $ultimodia = date('d',strtotime($data_final['data_final']));
        return $ultimodia;
    }

    public function mesApagar()
    {   
        $mesTotal = [];

        $dia = $this->ultimaDia();
        for ($i = 1; $i <= $dia; $i++) {     
            $data = date('Y-m',strtotime('now'));
            $aux = ($i < 10) ?'0'.$i:$i;
            $data = $data.'-'.$aux;

            $sql = "SELECT SUM(valor) AS valor FROM despesa WHERE vencimento = '$data' AND situacao = 'Apagar'";
            $query = MySQL::getInstancia()->prepare($sql);
            $query->execute();
            if ($query->rowCount() > 0) {
                $total = $query->fetch();
                if (!empty($total['valor'])) {
                    array_push($mesTotal,$total['valor']);
                } else {
                    array_push($mesTotal,0);
                }
            }
        }

        return implode(",",$mesTotal);
    }

    public function mesPago()
    {   
        $mesTotal = [];

        $dia = $this->ultimaDia();
        for ($i = 1; $i <= $dia; $i++) {     
            $data = date('Y-m',strtotime('now'));
            $aux = ($i < 10) ?'0'.$i:$i;
            $data = $data.'-'.$aux;

            $sql = "SELECT SUM(valor) AS valor FROM despesa WHERE vencimento = '$data' AND situacao = 'Pago'";
            $query = MySQL::getInstancia()->prepare($sql);
            $query->execute();
            if ($query->rowCount() > 0) {
                $total = $query->fetch();
                if (!empty($total['valor'])) {
                    array_push($mesTotal,$total['valor']);
                } else {
                    array_push($mesTotal,0);
                }
            }
        }

        return implode(",",$mesTotal);
    }
}