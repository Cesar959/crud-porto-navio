<?php 

// Incluindo o autoload
require_once "vendor/autoload.php";

// Chamando a class que sera usada
use Controler\Movimentacao;


// Limpando os dados 
$busca = filter_input(INPUT_GET, "busca", FILTER_SANITIZE_STRING);
$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_STRING);

// Conferindo os valores recebidos e inicio a paginação

$pagina = ($pagina == 0)? 1: $pagina;
$limite = 10;

// Verificando ser é busca ou listagem simples

if(!empty($busca))
{
    $movimentacao = new Movimentacao();
    $dados_movimentacao = $movimentacao->busca($busca, $pagina, $limite);
    $linhas = count($dados_movimentacao[0]);
}
else
{
    $movimentacao = new Movimentacao();
    $dados_movimentacao = $movimentacao->ler($pagina, $limite);
    $linhas = count($dados_movimentacao[0]);
}

// Script de Exclusão

if(isset($_GET['id']))
{
    // pagando o id por url
    $id_parametro = base64_decode($_GET['id']);
    $id = filter_var($id_parametro,  FILTER_SANITIZE_NUMBER_INT);

    // Instanciando a class livro
    $remocao = new Movimentacao();
    // Executando o metodo deletar()
    $remocao->deletar($id);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud - Movimentacao</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="resource/img/favicon.ico" type="image/x-icon">

    <!-- Estilo personalizado -->
    <link rel="stylesheet" href="resource/css/estilo.css">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

</head>
<body id="pagina-movimentacao" class="fundo">

    <div class="container">

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

        <?php include_once "include/menu.php" ?>

        <section class="painel">
            <img src="resource/img/menu.png" class="botao-menu" onclick="menu()" alt="Botão Menu">

            <div class="conteudo-painel">

                <div class="celula-titulo">
                    <h1>movimentacao</h1>
                    <a href="movimentacao-cadastro.php" class="botao-novo">novo</a>
                </div>
    
                <form class="celula-pesquisa" method="GET">
                    <input type="search" name="busca" value="<?php echo $busca;  ?>" placeholder="Pesquise por tipo de movimentação ...">
                    <button type="submit">pesquisar</button>
                </form>
    
                <table>
                    <thead>
                        <tr>
                            <th>Tipo Movimentação</th>
                            <th>Data e Hora de Inicio</th>
                            <th>Data e Hora de Fim</th>
                            <th>Opções</th>
                          </tr>
                    </thead>
                    <tbody>
                        <?php

                            for ($i=0; $i < $linhas; $i++) 
                            { 
                                // imprimindo as informações
                                $idMovimentacao = $dados_movimentacao[0][$i]['id_movimentacao'];
                                $tipoMovimentacao = str_replace("-", " ", $dados_movimentacao[0][$i]['tipo_movimentacao']);
                                $dataInicio = $dados_movimentacao[0][$i]['data_inicio'];
                                $horaInicio = $dados_movimentacao[0][$i]['hora_inicio'];
                                $dataFim = $dados_movimentacao[0][$i]['data_fim'];
                                $horaFim = $dados_movimentacao[0][$i]['hora_fim'];

                        ?>
                        <tr>
                            <td><?php echo $tipoMovimentacao ?></td>
                            <td><?php echo data($dataInicio) . " " . $horaInicio; ?></td>
                            <td><?php echo data($dataFim) . " " . $horaFim; ?></td>
                            <td>
                                <div class="opcoes">
                                    <a href="<?php echo "movimentacao-alteracao.php?id=" . base64_encode($idMovimentacao); ?>" class="editar"><i class='bx bxs-edit'></i></a>
                                    <a class="remover" onclick='confirmacaoModal("<?php echo base64_encode($idMovimentacao); ?>", "movimentacao.php")'><i class='bx bxs-trash-alt'></i></a>
                                </div>
                            </td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <?php  

                // Paginação
                
                // contidade de paginas
                $contidade =  $dados_movimentacao[1]; 

                // Descobrindo a contidade de listagens de registros
                $total_paginas = ceil($contidade/$limite);

                // verificando ser apginação não é 0
                if($total_paginas == 0)
                {
                    $total_paginas = 1;
                }

                // Criando os botôes 

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

                <!-- Exibindo a paginações  -->
                <?php if(!empty($busca)) { ?>
                    <div class="paginacao">
                        <a href="<?php echo 'movimentacao.php?busca=' . $busca . '&pagina=' . $anterior ; ?>"><i class='bx bx-left-arrow-alt'></i></a>
                        <span><?php echo $pagina . "/" . $total_paginas; ?></span>
                        <a href="<?php echo 'movimentacao.php?busca=' . $busca . '&pagina=' . $proximo ; ?>"><i class='bx bx-right-arrow-alt' ></i></a>
                    </div>
                    <?php } else {?>
                        <div class="paginacao">
                        <a href="<?php echo 'movimentacao.php?pagina=' . $anterior ; ?>"><i class='bx bx-left-arrow-alt'></i></a>
                        <span><?php echo $pagina . "/" . $total_paginas; ?></span>
                        <a href="<?php echo 'movimentacao.php?pagina=' . $proximo ; ?>"><i class='bx bx-right-arrow-alt' ></i></a>
                    </div>
                <?php }?>
                
            </div>



            <div class="modal">
                <h3>ALERTA</h3>
                <img src="resource/img/aviso.png" alt="Atenção">
                <p>Tem certeza que deseja excluir esse container ?</p>
                <div class="celula-botao">
                    <a href="movimentacao.php" class="botao-cancelar">cencelar</a>
                    <a class="botao-continua" id="botaoExclusao">remover</a>
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