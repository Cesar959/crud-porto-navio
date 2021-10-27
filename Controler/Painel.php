<?php

// Informando o namespace da class
namespace Controler;

// chamando a class que esta sendo estendida
use Model\Sql;

class Painel
{
    // Métodos

    // Responsavel por fazer a Contagem de Containers
    public function contagemContainer()
    {
        // Instancia a class
        $sql = new Sql();

        // No caso em questão não sera feito nem um envio de dados
        $parametros = array();

        // Executando o comando 'select' responsavel por selecionar  os dados no banco
        $resposta = $sql->select("SELECT  id_container FROM container", $parametros);

        // Fazendo a Contagem de Containers
        $contagem = count($resposta);

        // returnando um array
        return $contagem;
    }

    // Responsavel por fazer a Contagem de Movimentação
    public function contagemMovimentacao()
    {
        // Instancia a class
        $sql = new Sql();

        // No caso em questão não sera feito nem um envio de dados
        $parametros = array();

         // Executando o comando 'select' responsavel por selecionar  os dados no banco
        $resposta = $sql->select("SELECT  id_movimentacao FROM movimentacao", $parametros);

        // Fazendo a Contagem de Movimentações
        $contagem = count($resposta);

        // returnando um array
        return $contagem;

    }

}



?>