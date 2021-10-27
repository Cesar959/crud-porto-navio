<?php 

require_once "vendor/autoload.php";

use Controler\Movimentacao;

// Trazendo as informações baseado no id

// pagendo o id por parametro
$id_parametro = base64_decode($_GET['id']);
// filtrando o id 
$id = filter_var($id_parametro, FILTER_SANITIZE_NUMBER_INT);
// instanciando a class livro
$lista = new Movimentacao();
// setando o atributo id da class
$lista->__set("idMovimentacao", $id);
//executando o método listaRegistro
$registro = $lista->listaRegistro();


// Adicionado os dados em variaveis 
$tipoMovimentacao = $registro[0]['tipo_movimentacao'];
$dataInicio = $registro[0]['data_inicio'];
$horaIncio = $registro[0]['hora_inicio'];
$dataFim = $registro[0]['data_fim'];
$horaFim = $registro[0]['hora_fim'];


// Verificando ser os dados foram enviados

if(isset($_POST['alterar']))
{
    
    // Efetuando a limpea das informações enviadas
    $tipoMovimentacao = filter_input(INPUT_POST,"tipo_movimentacao", FILTER_SANITIZE_STRING );
    $dataInicio = filter_input(INPUT_POST,"data_inicio", FILTER_SANITIZE_STRING );
    $horaIncio = filter_input(INPUT_POST,"hora_inicio", FILTER_SANITIZE_STRING );
    $dataFim = filter_input(INPUT_POST,"data_fim", FILTER_SANITIZE_STRING);
    $horaFim = filter_input(INPUT_POST,"hora_fim", FILTER_SANITIZE_STRING );

    if($tipoMovimentacao == "" OR $dataInicio == "" OR $horaIncio == "" OR $dataFim == "" OR $horaFim == "")
    {
        header("Location: movimentacao-alteracao.php?id=" . base64_encode($id) . "&alerta=on");
    }
    else
    {
        // Instanciando a class livro
        $Movimentacao = new Movimentacao();

        // Setando os atributos
        $Movimentacao->__set("idMovimentacao",$id);
        $Movimentacao->__set("tipoMovimentacao",$tipoMovimentacao);
        $Movimentacao->__set("dataInicio",$dataInicio);
        $Movimentacao->__set("horaInicio",$horaIncio);
        $Movimentacao->__set("dataFim",$dataFim);
        $Movimentacao->__set("horaFim",$horaFim);

        // Executando o método alterar
        $Movimentacao->alterar();
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
                    <h1>Alteração</h1>
                </div>

                <form  method="post">

                    <div class="celula-total">
                        <label for="tipo_movimentacao">Tipo de Movimentaçâo</label>
                        <select name="tipo_movimentacao" id="tipoMovimentacao" onblur="validacaoCampo('tipoMovimentacao')">
                            <option value="" selected>Selecione ...</option>
                            <option value="embarque" <?php echo $tipoMovimentacao=='embarque'?'selected':'';?>>embarque</option>
                            <option value="descarga" <?php echo $tipoMovimentacao=='descarga'?'selected':'';?>>descarga</option>
                            <option value="gate	in" <?php echo $tipoMovimentacao=='gate	in'?'selected':'';?>>gate	in</option>
                            <option value="gate	out" <?php echo $tipoMovimentacao=='gate out'?'selected':'';?>>gate	out</option>
                            <option value="reposicionamento" <?php echo $tipoMovimentacao=='reposicionamento'?'selected':'';?>>reposicionamento</option>
                            <option value="pesagem" <?php echo $tipoMovimentacao=='pesagem'?'selected':'';?>>pesagem</option>
                            <option value="scanner" <?php echo $tipoMovimentacao=='scanner'?'selected':'';?>>scanner</option>
                        </select>
                        <div class="alerta-validacao" id="validacao-tipoMovimentacao">
                            Campo Tipo Movimentacao é Obrigatorio
                        </div>
                    </div>

                    <div class="celula-total-campo">
                        <div class="celula-metade">
                            <label for="data-hora-inicio">Data e Hora do Inicio</label>
                            <input type="date" name="data_inicio" id="data-inicio" value="<?php echo $dataInicio ?>" onblur="validacaoCampo('data-inicio')">
                            <div class="alerta-validacao" id="validacao-data-inicio">
                                Campo Data Inicio é Obrigatorio
                            </div>
                            <input type="time" name="hora_inicio" id="hora-inicio" value="<?php echo $horaIncio ?>" onblur="validacaoCampo('hora-inicio')">
                            <div class="alerta-validacao" id="validacao-hora-inicio">
                                Campo Hora Inicio é Obrigatorio
                            </div>
                        </div>
                        <div class="celula-metade">
                            <label for="data-hora-fim">Data e Hora do Fim</label>
                            <input type="date" name="data_fim" id="data-fim" value="<?php echo $dataFim ?>" onblur="validacaoCampo('data-fim')">
                            <div class="alerta-validacao" id="validacao-data-fim">
                                Campo Data Fim é Obrigatorio
                            </div>
                            <input type="time" name="hora_fim" id="hora-fim" value="<?php echo $horaFim ?>" onblur="validacaoCampo('hora-fim')">
                            <div class="alerta-validacao" id="validacao-hora-fim">
                                Campo Hora Fim é Obrigatorio
                            </div>
                        </div>
                    </div>

                    <div class="celula-botao">
                        <a href="movimentacao.php" class="botao-cancelar">cencelar</a>
                        <button type="submit" name="alterar" class="botao-continua">continua</button>
                    </div>
                    
                </form>
    

            </div>
 


        </section>


    </div>


    



    <!-- Script Personalizado -->
    <script src="resource/js/main.js"></script>

</body>
</html>