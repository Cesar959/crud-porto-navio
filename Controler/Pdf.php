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

    // Responsavel por fazer a contagem de Importações
    public function Importacao()
    {
        // Instancia a class
        $sql = new Sql();

        // No caso em questão não sera feito nem um envio de dados
        $parametros = array();

        // Executando o comando 'select' responsavel por selecionar  os dados no banco
        $dados_importacao = $sql->select("SELECT categoria FROM container WHERE categoria = 'Importação';", $parametros);
        $quantidade_importacao = count($dados_importacao);

        // retornando um valor
        return $quantidade_importacao;

    }

    // Responsavel por fazer a contagem de Importações
    public function Exportacao()
    {
        // Instancia a class
        $sql = new Sql();

        // No caso em questão não sera feito nem um envio de dados
        $parametros = array();

        // Executando o comando 'select' responsavel por selecionar  os dados no banco
        $dados_exportacao = $sql->select("SELECT categoria FROM container WHERE categoria = 'Exportação';", $parametros);
        $quantidade_exportacao = count($dados_exportacao);

        // retornando um valor
        return $quantidade_exportacao;

    }

}



?>