<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


function p($a)
{
    echo '<pre>';
    print_r($a);
    echo '</pre>';

}
function v($a)
{
    echo '<pre>';
    var_dump($a);
    echo '</pre>';

}


function clean_header($array)
{
    $CI = get_instance();
    $CI->load->helper('inflector');
    foreach ($array as $a) {
        $arr[] = humanize($a);
    }
    return $arr;
}

function validate_money($valor)
{

    if (preg_match("/^([0-9]*)\.(\d{2})$/", $valor)) {
        return true;
    }
    return false;

}


function debugCl($array){

    print '<pre>';

    print_r($array);

    var_dump($array);

    print '</pre>';

}
function debugEx($array){

    print '<pre>';

    print_r($array);

    var_dump($array);

    print '</pre>';

    exit;
}
function p_e($array){

    print '<pre>';
    print_r($array);
    print '</pre>';

    exit;
}

function data_pt($data='')
{
    $data = date('d/m/Y', strtotime($data));

    return $data;
}


function data_en($data='') {
    $data = str_replace("/", "-", $data);
    return date('Y-m-d', strtotime($data));

}


function zerosAEsquerda($valor='',$qtde=0) {
    return str_pad((string) $valor, $qtde , '0' ,STR_PAD_LEFT);
}
