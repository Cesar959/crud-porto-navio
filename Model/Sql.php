<?php

namespace Model;


class Sql extends \PDO
{
    private $host = HOST;
    private $banco = BANCO;
    private $usuario = USUARIO;
    private $senha = SENHA;
    private $conexao;


    public function __construct()
    {
        $this->conexao = new \PDO("mysql:host=$this->host;dbname=$this->banco", "$this->usuario", "$this->senha");
    }

    public function executaComando($sql, $parametros = array())
    {
        $stmt = $this->conexao->prepare($sql);

        foreach($parametros as $indice => $valor)
        {
            $stmt->bindValue($indice, $valor);
        }

        if($stmt->execute())
        {
            return $mensagem = true;
        }
        else
        {
            return $mensagem =  false;
        }
        
    }


    public function select($sql, $parametros = array())
    {
        $stmt = $this->conexao->prepare($sql);

        foreach($parametros as $indice => $valor)
        {
            $stmt->bindValue($indice, $valor);
        }

        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

}


?>