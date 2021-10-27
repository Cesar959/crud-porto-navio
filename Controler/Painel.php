<?php

namespace Controler;

use Model\Sql;

class Painel
{
    // Métodos

    public function contagemContainer()
    {
        $sql = new Sql();

        $parametros = array();

        $resposta = $sql->select("SELECT  id_container FROM container", $parametros);

        $contagem = count($resposta);

        return $contagem;
    }

    public function contagemMovimentacao()
    {
        $sql = new Sql();

        $parametros = array();

        $resposta = $sql->select("SELECT  id_movimentacao FROM movimentacao", $parametros);

        $contagem = count($resposta);

        return $contagem;

    }

}



?>