<?php

namespace Controler;

use Model\Sql;


class Container
{
    // atributos
    private $idContainer;
    private $cliente;
    private $numeroContainer;
    private $tipo;
    private $status;
    private $categoria;

    // Métodos

    public function __get($parametro)
    {
        return $this->$parametro;
    }

    public function __set($parametro, $valor)
    {
        $this->$parametro = $valor;
    }

    public function cadastro()
    {
        $sql = new Sql();

        $parametros = array(
            ":CLIENTE" => $this->cliente,
            ":NUMERO_CONTAINER" => $this->numeroContainer,
            ":TIPO" => $this->tipo,
            ":STATUS" => $this->status,
            ":CATEGORIA" => $this->categoria
        );

        $resposta = $sql->executaComando("INSERT INTO container (cliente, numero_container, tipo, status, categoria) VALUES 
        (:CLIENTE, :NUMERO_CONTAINER, :TIPO, :STATUS, :CATEGORIA)", $parametros);

        if($resposta == true)
        {
            header("Location:container.php?m=1");
            exit;
        }
        else
        {
            header('Location:container.php?m=2');
            exit;
        }

    }

    public function alterar()
    {
        $sql = new Sql();

        $parametros = array(
            ":ID" => $this->idContainer,
            ":CLIENTE" => $this->cliente,
            ":NUMERO_CONTAINER" => $this->numeroContainer,
            ":TIPO" => $this->tipo,
            ":STATUS" => $this->status,
            ":CATEGORIA" => $this->categoria
        );

        $resposta = $sql->executaComando("UPDATE container SET cliente= :CLIENTE, numero_container= :NUMERO_CONTAINER, tipo= :TIPO, status= :STATUS, categoria= :CATEGORIA WHERE id_container = :ID", $parametros);

        if($resposta == true)
        {
            header('Location:container.php?m=3');
            exit;
        }
        else
        {
            header('Location: container.php?m=4');
            exit;
        }
    }

    public function listaRegistro()
    {
        $sql = new Sql();

        $parametros = array(
            ":ID" => $this->idContainer
        );

        $resposta = $sql->select("SELECT  cliente, numero_container, tipo, status, categoria FROM container WHERE id_container = :ID", $parametros);

        return $resposta;
    }

    public function ler($pagina, $limite)
    {
        $sql = new Sql();

        $dados = array();

        $parametros = array();

        $total_registros = $sql->select("SELECT  id_container, cliente, numero_container, tipo, status, categoria FROM container", $parametros);
        $contidade_registros = count($total_registros);

        
        $inicio = $pagina - 1;
        $inicio = $inicio * $limite;
        
        $resultado = $sql->select("SELECT  id_container, cliente, numero_container, tipo, status, categoria FROM container LIMIT $limite OFFSET $inicio", $parametros);
        
        array_push($dados,  $resultado);
        array_push($dados,  $contidade_registros);

        return $dados;

    }

    public function busca($busca, $pagina, $limite)
    {
        $sql = new Sql();

        $dados = array();

        $parametros = array(
            ":BUSCA" => '%'. $busca .'%'
        );

        $total_registros = $sql->select("SELECT  id_container, cliente, numero_container, tipo, status, categoria FROM container WHERE cliente LIKE :BUSCA OR numero_container LIKE :BUSCA", $parametros);
        $contidade_registros = count($total_registros);

        
        $inicio = $pagina - 1;
        $inicio = $inicio * $limite;
        
        $resultado = $sql->select("SELECT  id_container, cliente, numero_container, tipo, status, categoria FROM container WHERE cliente LIKE :BUSCA OR numero_container LIKE :BUSCA LIMIT $limite OFFSET $inicio", $parametros);
        
        array_push($dados,  $resultado);
        array_push($dados,  $contidade_registros);

        return $dados;

    }

    public function deletar($id)
    {
        $sql = new Sql();

        $parametros = array(
            ":ID" => $id
        );

        $resposta = $sql->executaComando("DELETE FROM container WHERE id_container = :ID", $parametros);

        if($resposta == true)
        {
            header('Location: container.php?m=5');
        }
        else
        {
            header('Location: container.php?m=6');
        }
    }

}



?>