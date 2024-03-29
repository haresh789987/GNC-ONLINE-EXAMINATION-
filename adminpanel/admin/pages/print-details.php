<?php 
include("../../../conn.php");

require 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
        if(isset($_POST['sel'])){
             $sec=$_POST['sec'];
                    $co=$_POST['co'];
        $yr=$_POST['yr'];
 
$selExmne = $conn->query("SELECT * FROM examinee_tbl et INNER JOIN exam_attempt ea ON et.exmne_id = ea.exmne_id WHERE exmne_course='$co' AND exmne_year_level='$yr' AND exmne_section='$sec'  ORDER BY ea.examat_id DESC");

$user = $selExmne->fetch(PDO::FETCH_ASSOC);
        }
// instantiate and use the dompdf class
$dompdf = new Dompdf();
ob_start();
require('details_pdf.php');
$html =ob_get_contents();

ob_get_clean();

$dompdf->loadHtml($html);


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('print-details.pdf',['Attachment'=>false]);
 $options = $dompdf->getOptions(); 
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);