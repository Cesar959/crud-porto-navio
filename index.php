<?php

require_once __DIR__ . "/vendor/autoload.php";

use Controler\Painel;

$container = new Painel();
$quantidadeContainer = $container->contagemContainer();

$movimentacao = new Painel();
$quantidadeMovimentacao = $movimentacao->contagemMovimentacao();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud - Container</title>

    <!-- Estilo personalizado -->
    <link rel="stylesheet" href="resource/css/estilo.css">

</head>
<body id="pagina-inicial" class="fundo">

    <div class="container">

        <?php include_once "include/menu.php" ?>

        <section class="painel">

            <img src="resource/img/menu.png" class="botao-menu" onclick="menu()" alt="">

            <div class="conteudo-painel">
                <div class="grupo-card">
                    <div class="card">
                        <h2>CONTAINERS</h2>
                        <span><?php echo $quantidadeContainer; ?></span>
                    </div>
                    <div class="card">
                        <h2>MOVIMENTAÇÃO</h2>
                        <span><?php echo $quantidadeMovimentacao; ?></span>
                    </div>
                </div>
    
    
                <div class="exportacao">
                    <button>EXPORTAÇÃO</button>
                </div>
            </div>

        </section>


    </div>


    



    <!-- Script Personalizado -->
    <script src="resource/js/main.js"></script>

</body>
</html>