<?php 

// Incluindo o autoload
require_once "vendor/autoload.php";

// Chamando a class que sera utilizada
use Controler\Container;

// Verificando ser foi enviado o formulario

if(isset($_POST['cadastro']))
{
    // Efetuando a limpea das informações enviadas
    $cliente = filter_input(INPUT_POST,"cliente", FILTER_SANITIZE_STRING );
    $numeroContainer = filter_input(INPUT_POST,"numeroContainer", FILTER_SANITIZE_STRING );
    $tipo = filter_input(INPUT_POST,"tipo", FILTER_SANITIZE_STRING );
    $status = filter_input(INPUT_POST,"status", FILTER_SANITIZE_STRING);
    $categoria = filter_input(INPUT_POST,"categoria", FILTER_SANITIZE_STRING );

    if($cliente == "" OR $numeroContainer == "" OR $tipo == "" OR $status == "" OR $categoria == "")
    {
        header("Location: container-cadastro.php?alerta=on");
    }
    else
    {
        // Instanciando a class livro
        $cadastro = new Container();

        // Setando os atributos
        $cadastro->__set("cliente",$cliente);
        $cadastro->__set("numeroContainer", strtoupper($numeroContainer));
        $cadastro->__set("tipo",$tipo);
        $cadastro->__set("status",$status);
        $cadastro->__set("categoria",$categoria);
    
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
<body id="pagina-container-cadastro" class="fundo">

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
                        <label for="cliente">Cliente</label>
                        <input type="text" name="cliente" id="cliente" placeholder="Ex: Refinaria de São Gonçalo" onblur="validacaoCampo('cliente')">
                        <div class="alerta-validacao" id="validacao-cliente">
                            Campo Cliente é Obrigatorio
                        </div>
                    </div>
                    <div class="celula-total-campo">
                        <div class="celula-metade">
                            <label for="numeroContainer">Número do contêiner</label>
                            <input type="text" name="numeroContainer" id="numeroContainer" class="numero-container" placeholder="Ex: TEST1234567" onblur="validacaoCampo('numeroContainer')">
                            <div class="alerta-validacao" id="validacao-numeroContainer">
                                Campo Número do Contêiner é Obrigatorio
                            </div>
                        </div>
                        <div class="celula-metade">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" onblur="validacaoCampo('tipo')">
                                <option value="" selected>Selecione ...</option>
                                <option value="20">20</option>
                                <option value="40">40</option>
                            </select>
                            <div class="alerta-validacao" id="validacao-tipo">
                                Campo Tipo é Obrigatorio
                            </div>
                        </div>
                    </div>
                    <div class="celula-total-campo">
                        <div class="celula-metade">
                            <label for="status">Status</label>
                            <select name="status" id="status"  onblur="validacaoCampo('status')">
                                <option value="" selected>Selecione ...</option>
                                <option value="Cheio">Cheio</option>
                                <option value="Vazio">Vazio</option>
                            </select>
                            <div class="alerta-validacao" id="validacao-status">
                                Campo Status é Obrigatorio
                            </div>
                        </div>
                        <div class="celula-metade">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" onblur="validacaoCampo('categoria')">
                                <option value="" selected>Selecione ...</option>
                                <option value="Importação">Importação</option>
                                <option value="Exportação">Exportação</option>
                            </select>
                            <div class="alerta-validacao" id="validacao-categoria">
                                Campo Categoria é Obrigatorio
                            </div>
                        </div>
                    </div>
                    <div class="celula-botao">
                        <a href="container.php" class="botao-cancelar">cencelar</a>
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