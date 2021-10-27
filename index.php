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
                    <a href="<?php echo BASEURL . "/app/pdf/relatorio-painel.php"  ?>"><button>EXPORTAÇÃO</button></a>
                </div>
            </div>

        </section>


    </div>


    



    <!-- Script Personalizado -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="resource/js/main.js"></script>

</body>
</html>