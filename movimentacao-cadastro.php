<?php 

require_once "vendor/autoload.php";

use Controler\Movimentacao;

if(isset($_POST['cadastro']))
{
    // Efetuando a limpea das informações enviadas
    $tipoMovimentacao = filter_input(INPUT_POST,"tipoMovimentacao", FILTER_SANITIZE_STRING );
    $data_inicio = filter_input(INPUT_POST,"data_inicio", FILTER_SANITIZE_STRING );
    $hora_inicio = filter_input(INPUT_POST,"hora_inicio", FILTER_SANITIZE_STRING );
    $data_fim = filter_input(INPUT_POST,"data_fim", FILTER_SANITIZE_STRING);
    $hora_fim = filter_input(INPUT_POST,"hora_fim", FILTER_SANITIZE_STRING );

    if($tipoMovimentacao == "" OR $data_inicio == "" OR $hora_inicio == "" OR $data_fim == "" OR $hora_fim == "")
    {
        header("Location: movimentacao-cadastro.php?alerta=on");
    }
    else
    {
        // Instanciando a class livro
        $cadastro = new Movimentacao();

        // Setando os atributos
        $cadastro->__set("tipoMovimentacao",$tipoMovimentacao);
        $cadastro->__set("dataInicio",$data_inicio);
        $cadastro->__set("horaInicio",$hora_inicio);
        $cadastro->__set("dataFim",$data_fim);
        $cadastro->__set("horaFim",$hora_fim);
    
        // Executando o método cadastro
        $cadastro->cadastro();
    }

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
<body id="pagina-movimentacao-cadastro" class="fundo">

    <?php  if(isset($_GET['alerta']) and $_GET['alerta'] == 'on'){  ?>

    <div class="alerta alerta-atencao">
        <p>Preencha os Campos do Formulario!</p>
        <img src="resource/img/fecha.svg" onclick="fechaAlerta()" alt="Botão Fecha">
    </div>
        
    <?php  } ?>

    <div class="container">

        <?php include_once "include/menu.php" ?>

        <section class="painel">
            <img src="resource/img/menu.png" class="botao-menu" onclick="menu()" alt="">

            <div class="conteudo-painel">

                <div class="celula-titulo">
                    <h1>Cadastro</h1>
                </div>

                <form  method="post">

                    <div class="celula-total">
                        <label for="tipoMovimentacao">Tipo de Movimentaçâo</label>
                        <select name="tipoMovimentacao" id="tipoMovimentacao" onblur="validacaoCampo('tipoMovimentacao')">
                            <option value="" selected>Selecione ...</option>
                            <option value="embarque">embarque</option>
                            <option value="descarga">descarga</option>
                            <option value="gate	in">gate in</option>
                            <option value="gate	out">gate out</option>
                            <option value="reposicionamento">reposicionamento</option>
                            <option value="pesagem">pesagem</option>
                            <option value="scanner">scanner</option>
                        </select>
                        <div class="alerta-validacao" id="validacao-tipoMovimentacao">
                            Campo Tipo Movimentacao é Obrigatorio
                        </div>
                    </div>

                    <div class="celula-total-campo">
                        <div class="celula-metade">
                            <label for="data-hora-inicio">Data e Hora do Inicio</label>
                            <input type="date" name="data_inicio" id="data-inicio" onblur="validacaoCampo('data-inicio')">
                            <div class="alerta-validacao" id="validacao-data-inicio">
                                Campo Data Inicio é Obrigatorio
                            </div>
                            <input type="time" name="hora_inicio" id="hora-inicio" onblur="validacaoCampo('hora-inicio')">
                            <div class="alerta-validacao" id="validacao-hora-inicio">
                                Campo Hora Inicio é Obrigatorio
                            </div>
                        </div>
                        <div class="celula-metade">
                            <label for="data-hora-fim">Data e Hora do Fim</label>
                            <input type="date" name="data_fim" id="data-fim" onblur="validacaoCampo('data-fim')">
                            <div class="alerta-validacao" id="validacao-data-fim">
                                Campo Data Fim é Obrigatorio
                            </div>
                            <input type="time" name="hora_fim" id="hora-fim" onblur="validacaoCampo('hora-fim')">
                            <div class="alerta-validacao" id="validacao-hora-fim">
                                Campo Hora Fim é Obrigatorio
                            </div>
                        </div>
                    </div>

                    <div class="celula-botao">
                        <a href="movimentacao.php" class="botao-cancelar">cencelar</a>
                        <button type="submit" name="cadastro" class="botao-continua">continua</button>
                    </div>
                    
                </form>
    

            </div>
 


        </section>


    </div>



    <!-- Script Personalizado -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="resource/js/main.js"></script>

</body>
</html>