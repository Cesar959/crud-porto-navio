<?php

// Função para chamar automaticamente as class

spl_autoload_register(function($class)
{
    $fileModel = "Model" . DIRECTORY_SEPARATOR . $class . ".php";
    $fileControler = "Controler" . DIRECTORY_SEPARATOR . $class . ".php";

    // verificando ser a class existe no caminho
    if(file_exists($fileModel))
    {
        // Chamando o arquivo
        require_once $fileModel;
    }
    elseif(file_exists($fileControler))
    {
        // Chamando o arquivo
        require_once $fileControler;
    }
    else
    {
        throw new Exception("A class $class não foi localizadas");
    }


    
})



?>