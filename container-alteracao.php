<?php 


// Incluindo o autoload
require_once "vendor/autoload.php";

// Chamando a class que sera usada
use Controler\Container;

// Trazendo as informações baseado no id

// pagendo o id por parametro
$id_parametro = base64_decode($_GET['id']);
// filtrando o id 
$id = filter_var($id_parametro, FILTER_SANITIZE_NUMBER_INT);
// instanciando a class livro
$lista = new Container();
// setando o atributo id da class
$lista->idContainer =  $id;
//executando o método listaRegistro
$registro = $lista->listaRegistro();


// Adicionado os dados em variaveis 
$cliente = $registro[0]['cliente'];
$numeroContainer = $registro[0]['numero_container'];
$tipo = $registro[0]['tipo'];
$status = $registro[0]['status'];
$categoria = $registro[0]['categoria'];


// Verificando ser os dados foram enviados

if(isset($_POST['alterar']))
{
    
    // Efetuando a limpea das informações enviadas
    $cliente = filter_input(INPUT_POST,"cliente", FILTER_SANITIZE_STRING );
    $numeroContainer = filter_input(INPUT_POST,"numeroContainer", FILTER_SANITIZE_STRING );
    $tipo = filter_input(INPUT_POST,"tipo", FILTER_SANITIZE_STRING );
    $status = filter_input(INPUT_POST,"status", FILTER_SANITIZE_STRING);
    $categoria = filter_input(INPUT_POST,"categoria", FILTER_SANITIZE_STRING );

    if($cliente == "" OR $numeroContainer == "" OR $tipo == "" OR $status == "" OR $categoria == "")
    {
        header("Location: container-alteracao.php?id=" . base64_encode($id) . "&alerta=on");
    }
    else
    {
        // Instanciando a class livro
        $container = new Container();

        // Setando os atributos
        $container->idContainer = $id;
        $container->cliente = $cliente;
        $container->numeroContainer = strtoupper($numeroContainer);
        $container->tipo = $tipo;
        $container->status = $status;
        $container->categoria = $categoria;


        // Executando o método alterar
        $container->alterar();
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

    <!-- Favicon -->
    <link rel="shortcut icon" href="resource/img/favicon.ico" type="image/x-icon">

    <!-- Estilo personalizado -->
    <link rel="stylesheet" href="resource/css/estilo.css">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

</head>
<body id="pagina-container-alteracao" class="fundo">

    <?php  if(isset($_GET['alerta']) and $_GET['alerta'] == 'on'){  ?>

    <div class="alerta alerta-atencao">
        <p>Preencha os Campos do Formulario!</p>
        <img src="resource/img/fecha.svg" onclick="fechaAlerta()" alt="Botão Fecha">
    </div>
        iopioo
    <?php  } ?>

    <div class="container">

        <?php include_once "include/menu.php" ?>

        <section class="painel">
            <img src="resource/img/menu.png" class="botao-menu" onclick="menu()" alt="Botão Menu">

            <div class="conteudo-painel">

                <div class="celula-titulo">
                    <h1>Alteração</h1>
                </div>

                <form  method="post">
                    <div class="celula-total">
                        <label for="cliente">Cliente</label>
                        <input type="text" name="cliente" id="cliente" value="<?php echo $cliente ?>" placeholder="Ex: Refinaria de São Gonçalo" onblur="validacaoCampo('cliente')">
                        <div class="alerta-validacao" id="validacao-cliente">
                            Campo Cliente é Obrigatorio
                        </div>
                    </div>
                    <div class="celula-total-campo">
                        <div class="celula-metade">
                            <label for="numeroContainer">Número do contêiner</label>
                            <input type="text" name="numeroContainer" id="numeroContainer" class="numero-container" value="<?php echo $numeroContainer ?>" placeholder="Ex: TEST1234567" onblur="validacaoCampo('numeroContainer')">
                            <div class="alerta-validacao" id="validacao-numeroContainer">
                                Campo Número do Contêiner é Obrigatorio
                            </div>
                        </div>
                        <div class="celula-metade">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" onblur="validacaoCampo('tipo')">
                                <option value="">Selecione ...</option>
                                <option value="20" <?php echo $tipo=='20'?'selected':'';?> >20</option>
                                <option value="40" <?php echo $tipo=='40'?'selected':'';?>>40</option>
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
                                <option value="">Selecione ...</option>
                                <option value="Cheio" <?php echo $status=='Cheio'?'selected':'';?>>Cheio</option>
                                <option value="Vazio" <?php echo $status=='Vazio'?'selected':'';?>>Vazio</option>
                            </select>
                            <div class="alerta-validacao" id="validacao-status">
                                Campo Status é Obrigatorio
                            </div>
                        </div>
                        <div class="celula-metade">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" onblur="validacaoCampo('categoria')">
                                <option value="">Selecione ...</option>
                                <option value="Importação" <?php echo $categoria=='Importação'?'selected':'';?>>Importação</option>
                                <option value="Exportação" <?php echo $categoria=='Exportação'?'selected':'';?>>Exportação</option>
                            </select>
                            <div class="alerta-validacao" id="validacao-categoria">
                                Campo Categoria é Obrigatorio
                            </div>
                        </div>
                    </div>

                    <div class="celula-botao">
                        <a href="container.php" class="botao-cancelar">cencelar</a>
                        <button type="submit" name="alterar" class="botao-continua">continua</button>
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