<?php

// Informando o namespace da class
namespace Controler;

// chamando a class que esta sendo estendida
use Model\Sql;

class Pdf
{

    // Métodos

    // Responsavel por trazer os dados referente ao Container
    public function Container()
    {
        // Instancia a class
        $sql = new Sql();

        // No caso em questão não sera feito nem um envio de dados
        $parametros = array();

        // Executando o comando 'select' responsavel por selecionar  os dados no banco
        $dados_container = $sql->select("SELECT COUNT(cliente) as contidade, cliente FROM container GROUP BY cliente ORDER BY cliente", $parametros);

        // retornando um array
        return $dados_container;

    }

    // Responsavel por trazer os dados referente a Movimentacao
    public function Movimentacao()
    {
        // Instancia a class
        $sql = new Sql();

        // No caso em questão não sera feito nem um envio de dados
        $parametros = array();

        // Executando o comando 'select' responsavel por selecionar  os dados no banco
        $dados_container = $sql->select("SELECT COUNT(id_movimentacao) as contidade, tipo_movimentacao FROM `movimentacao` GROUP BY tipo_movimentacao;", $parametros);

        // retornando um array
        return $dados_container;

    }

}



?>