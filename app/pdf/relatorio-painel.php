<?php

require_once '../../vendor/autoload.php';

require_once "../../config.php";

// referenciando o namespace do dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

// instanciando o dompdf

$options = new Options();
$options->set(['enable_remote'=> true]);      
$dompdf = new Dompdf( $options );

//lendo o arquivo HTML correspondente
// $html = file_get_contents('modelo-pdf.php');

ob_start();
require_once "modelo-pdf.php";


$dompdf->loadHtml(ob_get_clean());

// Definindo o papel e a orientação

$dompdf->setPaper('A4', 'portrait');


// Renderizando o HTML como PDF

$dompdf->render();

// Enviando o PDF para o browser

$dompdf->stream("Relatorio");