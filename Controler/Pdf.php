<?php

namespace Controler;

use Model\Sql;

class Pdf
{

    // Métodos

    public function Container()
    {
        $sql = new Sql();

        $parametros = array();

        $dados_container = $sql->select("SELECT COUNT(cliente) as contidade, cliente FROM container GROUP BY cliente ORDER BY cliente", $parametros);

        return $dados_container;

    }

    public function Movimentacao()
    {

        $sql = new Sql();

        $parametros = array();

        $dados_container = $sql->select("SELECT COUNT(id_movimentacao) as contidade, tipo_movimentacao FROM `movimentacao` GROUP BY tipo_movimentacao;", $parametros);

        return $dados_container;

    }

}



?>