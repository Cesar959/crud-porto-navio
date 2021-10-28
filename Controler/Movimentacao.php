<?php

// Informando o namespace da class
namespace Controler;

// chamando a class que esta sendo estendida
use Model\Sql;

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

     // Responsavel por pegar o atributo
    public function __get($parametro)
    {
        return $this->$parametro;
    }

    // Responsavel por setar o atributo
    public function __set($parametro, $valor)
    {
        $this->$parametro = $valor;
    }

    // Responsavel Por efetuar o Cadastro (Creat)
    public function cadastro()
    {
        // Instancia a class
        $sql = new Sql();

        // Dados que serão cadastrados
        $parametros = array(
            ":TIPO_MOVIMENTACAO" => $this->tipoMovimentacao,
            ":DATA_INICIO" => $this->dataInicio,
            ":HORA_INICIO" => $this->horaInicio,
            ":DATA_FIM" => $this->dataFim,
            ":HORA_FIM" => $this->horaFim
        );

        // Executando o comando 'executaComando' responsavel por enviar o sql para o banco de dados
        $resposta = $sql->executaComando("INSERT INTO movimentacao 
        (tipo_movimentacao, data_inicio, hora_inicio, data_fim, hora_fim) 
        VALUES 
        (:TIPO_MOVIMENTACAO, :DATA_INICIO, :HORA_INICIO, :DATA_FIM, :HORA_FIM)", $parametros);

        // Vereficando ser o insert foi bem sucedido
        if($resposta == true)
        {
            header("Location:movimentacao.php?m=1");
        }
        else
        {
            header('Location:movimentacao.php?m=2');
        }

    }

     // Responsavel por efetuar a atualização dos dados (Update)
    public function alterar()
    {
        // Instanciando a class
        $sql = new Sql();

        // Dados que serão atualizados
        $parametros = array(
            ":ID" => $this->idMovimentacao,
            ":TIPO_MOVIMENTACAO" => $this->tipoMovimentacao,
            ":DATA_INICIO" => $this->dataInicio,
            ":HORA_INICIO" => $this->horaInicio,
            ":DATA_FIM" => $this->dataFim,
            ":HORA_FIM" => $this->horaFim
        );

        // Executando o comando 'executaComando' responsavel por enviar o sql para o banco de dados
        $resposta = $sql->executaComando("UPDATE movimentacao SET 
        tipo_movimentacao= :TIPO_MOVIMENTACAO, 
        data_inicio= :DATA_INICIO, 
        hora_inicio= :HORA_INICIO, 
        data_fim= :DATA_FIM, 
        hora_fim= :HORA_FIM 
        WHERE 
        id_movimentacao = :ID", $parametros);

        // Vereficando ser o update foi bem sucedido
        if($resposta == true)
        {
            header('Location: movimentacao.php?m=3');
        }
        else
        {
            header('Location: movimentacao.php?m=4');
        }
    }

     // Responsavel por exibir apenas um registro
    public function listaRegistro()
    {
        // Instanciando a class
        $sql = new Sql();

        // dados que serão usados como parametro de pesquisa (WHERE)
        $parametros = array(
            ":ID" => $this->idMovimentacao
        );

        // Executando o comando 'executaComando' responsavel por enviar o sql para o banco de dados
        $resposta = $sql->select("SELECT  tipo_movimentacao, data_inicio, hora_inicio, data_fim, hora_fim 
        FROM 
        movimentacao 
        WHERE 
        id_movimentacao = :ID", $parametros);

        // Retornando um array com os valores
        return $resposta;
    }

    // Responsavel por exibir todos os registros (Read)
    public function ler($pagina, $limite)
    {
        // Instanciando a class
        $sql = new Sql();

        // Varivel definida como array
        $dados = array();

        // No caso em questão não sera feito nem um envio de dados
        $parametros = array();

        // Executando o comando 'select' responsavel por selecionar  os dados no banco
        $total_registros = $sql->select("SELECT  id_movimentacao, tipo_movimentacao, data_inicio, hora_inicio, data_fim, hora_fim 
        FROM 
        movimentacao", $parametros);
        $contidade_registros = count($total_registros);
        
         // Instrução para o SELECT da onde deve ser iniciado a seleção
        $inicio = $pagina - 1;
        $inicio = $inicio * $limite;
        
        // Executando o comando 'select' responsavel por selecionar  os dados no banco junto com o limit e offset
        $resultado = $sql->select("SELECT  id_movimentacao, tipo_movimentacao, data_inicio, hora_inicio, data_fim, hora_fim 
        FROM 
        movimentacao 
        LIMIT 
        $limite 
        OFFSET 
        $inicio", $parametros);
        
        // Adicionando os resultados dentro de um array bidimensional
        array_push($dados,  $resultado);
        array_push($dados,  $contidade_registros);

        // retornando os dados
        return $dados;

    }

    // Responsavel por exibir todos os registros baseado no campo de pesquisa
    public function busca($busca, $pagina, $limite)
    {
         // Instanciando a class
        $sql = new Sql();

        // Varivel definida como array
        $dados = array();

         // dados que serão usados como parametro de pesquisa (LIKE)
        $parametros = array(
            ":BUSCA" => '%'. $busca .'%'
        );

        // Executando o comando 'select' responsavel por selecionar  os dados no banco
        $total_registros = $sql->select("SELECT  id_movimentacao, tipo_movimentacao, data_inicio, hora_inicio, data_fim, hora_fim 
        FROM 
        movimentacao 
        WHERE 
        tipo_movimentacao 
        LIKE :BUSCA", $parametros);
        $contidade_registros = count($total_registros);

        // Instrução para o SELECT da onde deve ser iniciado a seleção
        $inicio = $pagina - 1;
        $inicio = $inicio * $limite;
        
         // Executando o comando 'select' responsavel por selecionar  os dados no banco junto com o limit e offset
        $resultado = $sql->select("SELECT  id_movimentacao, tipo_movimentacao, data_inicio, hora_inicio, data_fim, hora_fim 
        FROM 
        movimentacao 
        WHERE 
        tipo_movimentacao 
        LIKE :BUSCA 
        LIMIT $limite 
        OFFSET $inicio", $parametros);
        
         // Adicionando os resultados dentro de um array bidimensional
        array_push($dados,  $resultado);
        array_push($dados,  $contidade_registros);

        // retornando os dados
        return $dados;

    }

    // Responsavel por deletar o registro do banco de dados (Delete)
    public function deletar($id)
    {
         // Instanciando a class
        $sql = new Sql();

        // dados que serão usados como parametro de pesquisa (WHERE)
        $parametros = array(
            ":ID" => $id
        );

        // Executando o comando 'executaComando' responsavel por enviar o sql para o banco de dados
        $resposta = $sql->executaComando("DELETE FROM movimentacao WHERE id_movimentacao = :ID", $parametros);

        // Vereficando ser o delete foi bem sucedido
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