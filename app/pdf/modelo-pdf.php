<?php

// Incluindo o autoload
require_once '../../vendor/autoload.php';

// Informando as class que serão usadas
use Controler\Painel;
use Controler\Pdf;

// instanciando a class
$pdf = new Pdf;
$dados_container = $pdf->Container();
$linha_container = count($dados_container);

$dados_movimentacao = $pdf->Movimentacao();
$linha_movimentacao = count($dados_movimentacao);

// instanciando a class
$resumo = new Painel;
$quantidade_container = $resumo->contagemContainer();
$quantidade_movimentacao = $resumo->contagemMovimentacao();

?>

<!-- Modelo do PDF de Relatorio -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teste</title>

    <style>

        .cabecalo
        {
            text-align: center;
        }
        
        .cabecalo h1, p
        {
            text-align: center;
        }

        .cabecalo img
        {
            width: 300px;
        }

        table
        {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid black;
            margin-bottom: 60px;
        }

        tr,th, td
        {
            font-family: sans-serif;
            border: 2px solid black;
            padding: 10px;
        }

        h2
        {
            font-family: sans-serif;
        }

        .resumo
        {
            display: block;
            width: 100%;
            font-family: sans-serif;
        }
        
    </style>
</head>
<body>

<div class="cabecalo">
    <h1>RELATORIO GERAL</h1>
    <p><?php echo date("d/m/Y H:i:s"); ?></p>
    <img src="http://localhost/crud-container/app/pdf/navio-grande.png" alt="">
</div>


<h2>Container</h2>
<table>
    <thead>
        <tr>
            <th>Contidade</th>
            <th>Cliente</th>
        </tr>
    </thead>
    <tbody>

        <?php for ($i=0; $i < $linha_container; $i++) { ?>
        <tr>
            <td><?php echo $dados_container[$i]['contidade'] ?></td>
            <td><?php echo $dados_container[$i]['cliente'] ?></td>
        </tr>
        <?php }  ?>

    </tbody>
</table>



<h2>Movimentação</h2>
<table>
    <thead>
        <tr>
            <th>Contidade</th>
            <th>Tipo Container</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i=0; $i < $linha_movimentacao; $i++) { ?>

        <tr>
            <td><?php echo $dados_movimentacao[$i]['contidade'] ?></td>
            <td><?php echo $dados_movimentacao[$i]['tipo_movimentacao'] ?></td>
        </tr>
        <?php }  ?>

    </tbody>
</table>


<div class="resumo">
    <h3>Resumo</h3>
    <table>
    <thead>
        <tr>
            <th>Container</th>
            <th>Movimentacao</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $quantidade_container ?></td>
            <td><?php echo $quantidade_movimentacao ?></td>
        </tr>
    </tbody>
</table>
</div>



    
</body>
</html>

