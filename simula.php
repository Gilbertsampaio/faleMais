<?php
header('Cache-Control: no-cache');
header('Content-type: application/xml; charset="utf-8"', true);

function moneyMask($value = 0)
{
    return number_format($value, 2, ',', '.');
}

include "conexao.php";

$origem = $_REQUEST['origem'];
$destino = $_REQUEST['destino'];
$planoID = $_REQUEST['planoID'];
$tempo = $_REQUEST['tempo'];
$planoPlano = $_REQUEST['planoPlano'];

$resultado = array();

$tarifa = mysqli_fetch_object(mysqli_query($connect, "SELECT tarifa FROM tabela WHERE origem = $origem AND destino = $destino"));
$plano = mysqli_fetch_object(mysqli_query($connect, "SELECT tempo, plano FROM plano WHERE id = $planoID"));

$comFaleMais = ($tempo - $plano->tempo) * ($tarifa->tarifa + (($tarifa->tarifa * 10) / 100));
$semFaleMais = $tempo * $tarifa->tarifa;

$resultado[] = array(
    'origem'        => $origem,
    'destino'   => $destino,
    'tempo'   => $tempo,
    'plano'   => $plano->plano,
    'comFaleMais'   => $tempo <= $plano->tempo ? ' <i class="icon-minus"></i> ' : 'R$ '.moneyMask($comFaleMais),
    'semFaleMais'   => 'R$ '.moneyMask($semFaleMais),
);

echo (json_encode($resultado));
