<?php 
include("../../../conn.php");

require 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
        if(isset($_POST['sel'])){

        }
// instantiate and use the dompdf class
$dompdf = new Dompdf();
ob_start();
require('preview_questions.php');
$html =ob_get_contents();

ob_get_clean();

$dompdf->loadHtml($html);


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('print.pdf',['Attachment'=>false]);
 $options = $dompdf->getOptions(); 
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);