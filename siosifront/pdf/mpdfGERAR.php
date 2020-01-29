<?php

/*
// reference the Dompdf namespace
require('./dompdf/vendor/autoload.php');
use Dompdf\Dompdf;
$dompdf = new Dompdf();


$html = '
<div style="padding:50px;">
teste

</div>
';

$dompdf->loadHtml($html);


$dompdf->render();
$dompdf->stream();

echo $_POST['header'];
*/




/*
require('./fpdf181/fpdf.php');

$pdf = new FPDF();

$html = `
    <div style="border-top:3px solid #4dc168;">
        <div style="display:table;width:100%;text-align:center;background-color: #ededed;">
            <div style="float:left;width:20%;">
                <img src="img/logo-black.png" style="padding:15px;height:50px;width:auto;margin:0px auto;">
            </div>
            <div style="float:left;width:60%;padding-top:20px">
                +dataResultado.processo.nome+
            </div>
            <div style="float:left;width:20%;padding-top:20px">
                +dataResultado.processo.documento+
            </div>
        </div>
        <div style="width:100%;display:table;text-align:center;padding:5px;border-top:1px solid #7f7f7f;">
            <div style="width:15%;float:left;border-right:1px solid #7f7f7f;">
                Legenda
            </div>
            <div style="width:28%;float:left;">
                NC - Não conforme
            </div>
            <div style="width:28%;float:left;">
                Legenda:
            </div>
            <div style="width:28%;float:left;">
                R - Reauditado
            </div>
        </div>
    </div>
`;

$pdf->WriteHTML($html);
$pdf->Output();
*/







/*

require_once('./TCPDF-master/tcpdf.php');  
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$header = <<<EOD

<div>
    teste
</div>

EOD;

$pdf->SetHeaderData(0, 0, '', '', $header, 0, 1, 0, true, '', true);
$pdf->setFooterData(0, 0, '', '', $header, 0, 1, 0, true, '', true);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->AddPage();
$html = '';
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Output('pdf/relatorio.pdf', 'I');
*/







// require_once __DIR__ . './mpdf/vendor/autoload.php';
include 'mpdf/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['UTF-8' , 'margin_top' => '35','margin_bottom' => '35']);

// $mpdf->SetHtmlHeader('<div style="padding:10px;">teste</div>');
// $mpdf->SetHtmlFooter('<div style="padding:10px;">teste</div>');
// $mpdf->WriteHTML('<div style="padding:10px;">teste</div>');

$mpdf->SetHtmlHeader($_POST['header']);
$mpdf->SetHtmlFooter($_POST['footer']);
$mpdf->WriteHTML($_POST['body']);

$mpdf->SetJS('this.print();');
$mpdf->Output('relatorio.pdf','F');


?>
