<?php

class Movimentacao
{
    // atributos
    private $idMovimentacao;
    private $tipoMovimentacao;
    private $dataInicio;
    private $horaInicio;
    private $dataFim;
    private $horaFim;

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
            ":TIPO_MOVIMENTACAO" => $this->tipoMovimentacao,
            ":DATA_INICIO" => $this->dataInicio,
            ":HORA_INICIO" => $this->horaInicio,
            ":DATA_FIM" => $this->dataFim,
            ":HORA_FIM" => $this->horaFim
        );

        $resposta = $sql->executaComando("INSERT INTO movimentacao (tipo_movimentacao, data_inicio, hora_inicio, data_fim, hora_fim) VALUES 
        (:TIPO_MOVIMENTACAO, :DATA_INICIO, :HORA_INICIO, :DATA_FIM, :HORA_FIM)", $parametros);

        if($resposta == true)
        {
            header("Location:movimentacao.php?m=1");
            exit;
        }
        else
        {
            header('Location:movimentacao.php?m=2');
            exit;
        }

    }

    public function alterar()
    {
        $sql = new Sql();

        $parametros = array(
            ":ID" => $this->idMovimentacao,
            ":TIPO_MOVIMENTACAO" => $this->tipoMovimentacao,
            ":DATA_INICIO" => $this->dataInicio,
            ":HORA_INICIO" => $this->horaInicio,
            ":DATA_FIM" => $this->dataFim,
            ":HORA_FIM" => $this->horaFim
        );

        $resposta = $sql->executaComando("UPDATE movimentacao SET 
        tipo_movimentacao= :TIPO_MOVIMENTACAO, 
        data_inicio= :DATA_INICIO, 
        hora_inicio= :HORA_INICIO, 
        data_fim= :DATA_FIM, 
        hora_fim= :HORA_FIM 
        WHERE 
        id_movimentacao = :ID", $parametros);

        if($resposta == true)
        {
            header('Location: movimentacao.php?m=3');
            exit;
        }
        else
        {
            header('Location: movimentacao.php?m=4');
            exit;
        }
    }

    public function listaRegistro()
    {
        $sql = new Sql();

        $parametros = array(
            ":ID" => $this->idMovimentacao
        );

        $resposta = $sql->select("SELECT  tipo_movimentacao, data_inicio, hora_inicio, data_fim, hora_fim FROM movimentacao WHERE id_movimentacao = :ID", $parametros);

        return $resposta;
    }

    public function ler($pagina, $limite)
    {
        $sql = new Sql();

        $dados = array();

        $parametros = array();


        $total_registros = $sql->select("SELECT  id_movimentacao, tipo_movimentacao, data_inicio, hora_inicio, data_fim, hora_fim FROM movimentacao", $parametros);
        $contidade_registros = count($total_registros);
        
        $inicio = $pagina - 1;
        $inicio = $inicio * $limite;
        
        $resultado = $sql->select("SELECT  id_movimentacao, tipo_movimentacao, data_inicio, hora_inicio, data_fim, hora_fim FROM movimentacao LIMIT $limite OFFSET $inicio", $parametros);
        
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

        $total_registros = $sql->select("SELECT  id_movimentacao, tipo_movimentacao, data_inicio, hora_inicio, data_fim, hora_fim FROM movimentacao WHERE tipo_movimentacao LIKE :BUSCA", $parametros);
        $contidade_registros = count($total_registros);

        
        $inicio = $pagina - 1;
        $inicio = $inicio * $limite;
        
        $resultado = $sql->select("SELECT  id_movimentacao, tipo_movimentacao, data_inicio, hora_inicio, data_fim, hora_fim FROM movimentacao WHERE tipo_movimentacao LIKE :BUSCA LIMIT $limite OFFSET $inicio", $parametros);
        
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

        $resposta = $sql->executaComando("DELETE FROM movimentacao WHERE id_movimentacao = :ID", $parametros);

        print_r($resposta);

        if($resposta == true)
        {
            header('Location: movimentacao.php?m=5');
        }
        else
        {
            header('Location: movimentacao.php?m=6');
        }
    }

}



?>