<?php 

require_once "vendor/autoload.php";

use Controler\Container;

$busca = filter_input(INPUT_GET, "busca", FILTER_SANITIZE_STRING);
$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_STRING);

$pagina = ($pagina == 0)? 1: $pagina;
$limite = 10;

if(!empty($busca))
{
    $container = new Container();
    $dados_containe = $container->busca($busca, $pagina, $limite);
    $linhas = count($dados_containe[0]);
}
else
{
    $container = new Container();
    $dados_containe = $container->ler($pagina, $limite);
    $linhas = count($dados_containe[0]);
}


// Script de Exclusão

if(isset($_GET['id']))
{
    // pagando o id por url
    $id_parametro = base64_decode($_GET['id']);
    $id = filter_var($id_parametro,  FILTER_SANITIZE_NUMBER_INT);

    // Instanciando a class livro
    $remocao = new Container();
    // Executando o metodo deletar()
    $remocao->deletar($id);
    print_r($remocao);
}

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

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

</head>
<body id="pagina-container" class="fundo">

     

<?php  if(isset($_GET['m']) and $_GET['m'] == 1){  ?>

    <div class="alerta alerta-sucesso">
        <p>Cadastro realidado com sucesso!</p>
        <img src="resource/img/fecha.svg" onclick="fechaAlerta()" alt="Botão Fecha">
    </div>
        
 <?php  } ?>



<?php  if(isset($_GET['m']) and $_GET['m'] == 2){ ?>
    
    <div class="alerta alerta-erro">
        <p>Ops!!, Não foi possivel cadastrar!</p>
        <img src="resource/img/fecha.svg" onclick="fechaAlerta()" alt="Botão Fecha">
    </div>
        
<?php  } ?>



<?php  if(isset($_GET['m']) and $_GET['m'] == 3){ ?>
    
    <div class="alerta alerta-sucesso">
            <p>Alteração realizada com sucesso!</p>
            <img src="resource/img/fecha.svg" onclick="fechaAlerta()" alt="Botão Fecha">
        </div>
        
<?php  } ?>



<?php  if(isset($_GET['m']) and $_GET['m'] == 4){ ?>
    
    <div class="alerta alerta-erro">
        <p>Ops!!, Não foi possivel alterar!</p>
        <img src="resource/img/fecha.svg" onclick="fechaAlerta()" alt="Botão Fecha">
    </div>
        
<?php  } ?>



<?php  if(isset($_GET['m']) and $_GET['m'] == 5) { ?>
    
    <div class="alerta alerta-sucesso">
        <p>Exclusão realizada com sucesso!</p>
        <img src="resource/img/fecha.svg" onclick="fechaAlerta()" alt="Botão Fecha">
    </div>
        
<?php  } ?>



<?php if(isset($_GET['m']) and $_GET['m'] == 6){ ?>

    <div class="alerta alerta-erro">
        <p>"Ops!!, Não foi possivel excluir!</p>
        <img src="resource/img/fecha.svg" onclick="fechaAlerta()" alt="Botão Fecha">
    </div>
        
<?php  } ?>


    <div class="container">

        <?php include_once "include/menu.php" ?>

        <section class="painel">
            <img src="resource/img/menu.png" class="botao-menu" onclick="menu()" alt="">

            <div class="conteudo-painel">

                <div class="celula-titulo">
                    <h1>container</h1>
                    <a href="container-cadastro.php" class="botao-novo">novo</a>
                </div>
    
                <form class="celula-pesquisa" method="GET">
                    <input type="search" name="busca" value="<?php echo $busca;  ?>" placeholder="Digite a pesquisa ...">
                    <button type="submit">pesquisar</button>
                </form>
    
                <table>
                    <thead>
                        <tr>
                            <th>Contêiner</th>
                            <th>Cliente</th>
                            <th>Tipo</th>
                            <th>Status</th>
                            <th>Categoria</th>
                            <th>Opções</th>
                          </tr>
                    </thead>
                    <tbody>
                        <?php

                            for ($i=0; $i < $linhas; $i++) 
                            { 
                                $idContainer = $dados_containe[0][$i]['id_container'];
                                $cliente = $dados_containe[0][$i]['cliente'];
                                $numeroContainer = $dados_containe[0][$i]['numero_container'];
                                $tipo = $dados_containe[0][$i]['tipo'];
                                $status = $dados_containe[0][$i]['status'];
                                $categoria = $dados_containe[0][$i]['categoria'];
                            
                        ?>

                        <tr>
                            <td><?php echo $numeroContainer ?></td>
                            <td><?php echo $cliente ?></td>
                            <td><?php echo $tipo ?></td>
                            <td><?php echo $status ?></td>
                            <td><?php echo $categoria ?></td>
                            <td>
                                <div class="opcoes">
                                    <a href="<?php echo 'container-alteracao.php?id=' .base64_encode($idContainer);  ?>" class="editar"><i class='bx bxs-edit'></i></a>
                                    <a class="remover" onclick='confirmacaoModal("<?php echo base64_encode($idContainer); ?>", "container.php")'><i class='bx bxs-trash-alt'></i></a>
                                </div>
                            </td>
                        </tr>

                        <?php } ?>

                    </tbody>
                </table>

                <?php  
                
                $contidade =  $dados_containe[1]; 

                $total_paginas = ceil($contidade/$limite);

                if(($pagina - 1) <= 0)
                {
                    $anterior = 1;
                }
                else 
                {
                    $anterior = $pagina - 1;
                }

                if(($pagina + 1) > $total_paginas)
                {
                    $proximo = $total_paginas;
                }
                else 
                {
                    $proximo = $pagina + 1;
                }


                ?>

                <?php if(!empty($busca)) { ?>
                <div class="paginacao">
                    <a href="<?php echo 'container.php?busca=' . $busca . '&pagina=' . $anterior ; ?>"><i class='bx bx-left-arrow-alt'></i></a>
                    <span><?php echo $pagina; ?></span>
                    <a href="<?php echo 'container.php?busca=' . $busca . '&pagina=' . $proximo ; ?>"><i class='bx bx-right-arrow-alt' ></i></a>
                </div>
                <?php } else {?>
                    <div class="paginacao">
                    <a href="<?php echo 'container.php?pagina=' . $anterior ; ?>"><i class='bx bx-left-arrow-alt'></i></a>
                    <span><?php echo $pagina; ?></span>
                    <a href="<?php echo 'container.php?pagina=' . $proximo ; ?>"><i class='bx bx-right-arrow-alt' ></i></a>
                </div>
                <?php }?>

            </div>



            <div class="modal">
                <h3>ALERTA</h3>
                <img src="resource/img/aviso.png" alt="">
                <p>Tem certeza que deseja excluir esse container ?</p>
                <div class="celula-botao">
                    <a href="container.php" class="botao-cancelar">cencelar</a>
                    <a class="botao-continua" id="botaoExclusao">remover</a>
                </div>
            </div>
 


        </section>




    </div>


    



    <!-- Script Personalizado -->
    <script src="resource/js/main.js"></script>

</body>
</html>