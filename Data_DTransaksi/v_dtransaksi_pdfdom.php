<?php include "../koneksi.php";
session_start();

// Include autoloader 
require_once '../dompdf/autoload.inc.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf; 
 
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();

ob_start();
// require "v_dtransaksi_invoice_print.php"; // the one you posted in your question
$html = ob_get_clean();

// Load content from html file 
// $pdf = file_get_contents("v_dtransaksi_invoice_print.php"); 
$dompdf->load_html($html); 
 
// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'landscape'); 
 
// Render the HTML as PDF 
$dompdf->render(); 
 
// Output the generated PDF (1 = download and 0 = preview) 
$dompdf->stream("codexworld", array("Attachment" => 0));

?>