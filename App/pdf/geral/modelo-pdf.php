<?php
// Incluindo o autoload
require_once '../../../vendor/autoload.php';

// Informando as class que serão usadas
use Controler\Painel;
use Controler\Pdf;

// instanciando a class
$pdf = new Pdf;
$dados_container = $pdf->Container();
$linha_container = count($dados_container);

$dados_movimentacao = $pdf->Movimentacao();
$linha_movimentacao = count($dados_movimentacao);

$quantidade_importacao = $pdf->Importacao();
$quantidade_exportacao = $pdf->Exportacao();

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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatorio Geral</title>

    <style>

        h1
        {
            font-family: sans-serif;
        }

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

        .resumo h2
        {
            text-align: center;
            font-family: sans-serif;
        }

        /* cabeçalho */
        @page 
        { 
            margin: 120px 50px 80px 50px; 
        } 

        #head
        { 
            font-size: 20px; 
            text-align: center; 
            height: 130px; 
            width: 100%; 
            position: fixed; 
            top: -130px; 
            left: 0; 
            right: 0; 
            margin: auto; 
        } 
        #body
        { 
            width: 600px; 
            position: relative; 
            margin: auto; 
        } 
        
        #footer 
        { 
            position: fixed; 
            bottom: 0;
            width: 100%;
            text-align: right;
            border-top: 1px solid gray; 
        }
        
        #footer .page:after
        { 
            content: counter(page); 
        }
        
    </style>
</head>
<body>

<div class="cabecalo">
    <h1>RELATORIO GERAL</h1>
    <p><?php echo date("d/m/Y H:i:s"); ?></p>
    <img src="http://localhost/crud-container/App/pdf/geral/navio-grande.png" alt="Imagem de Navio Grande">
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
    <h2>Resumo</h2>
    <table>
        <thead>
            <tr>
                <th>Quantidade Container</th>
                <th>Quantidade Movimentacao</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $quantidade_container ?></td>
                <td><?php echo $quantidade_movimentacao ?></td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th>Quantidade Importação</th>
                <th>Quantidade Exportação</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $quantidade_importacao ?></td>
                <td><?php echo $quantidade_exportacao?></td>
            </tr>
        </tbody>
    </table>
</div>



    
</body>
</html>

