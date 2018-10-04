<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function pdf_create($html, $filename, $stream = true, $landscape = false)
{

    require_once APPPATH . 'helpers/mpdf/mpdf.php';
    // $mpdf = new \Mpdf\Mpdf([
    //     'mode' => 'c',
    //     'margin_left' => 32,
    //     'margin_right' => 25,
    //     'margin_top' => 27,
    //     'margin_bottom' => 25,
    //     'margin_header' => 16,
    //     'margin_footer' => 13
    // ]);
    if($landscape){
        $mpdf = new mPDF('c', 'A4-L');
    }else{
        $mpdf = new mPDF('c', 'A4');
    }
    // Load a stylesheet
    $stylesheet = file_get_contents('../../assets/css/style.css');

    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->WriteHTML($html);
    $mpdf->Output();

    // if ($stream) {
    //     $mpdf->Output($filename . '.pdf', 'I');
    // } else {
    //     $mpdf->Output('./uploads/temp/' . $filename . '.pdf', 'F');

    //     return './uploads/temp/' . $filename . '.pdf';
    // }
}
