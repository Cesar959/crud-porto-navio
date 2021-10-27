<?php

// Configurações do Crud


// Conexão com o banco de dados

define("HOST","localhost");
define("BANCO","crud-container");
define("USUARIO","root");
define("SENHA","");



// Base da URl
define("BASEURL", "http://localhost/crud-container/");


// Cinfiguração de Fuso Horario
date_default_timezone_set('America/Sao_Paulo');


// Funções Gerais do projeto
function data($data){
    return date("d/m/Y", strtotime($data));
}








?>