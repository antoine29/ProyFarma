<?php

echo "llego";
require_once "../models/Reporte.php";


if (empty($_POST['submit']))
{
      header("Location:" . Reporte::baseurl() . "app/listaReporte.php");
      exit;
}

$args = array(
	'email'	=> FILTER_SANITIZE_STRING,
    'contenido'  => FILTER_SANITIZE_STRING,
);

$post = (object)filter_input_array(INPUT_POST, $args);

$db = new Database;
$reporte = new Reporte($db);


$id = reporte->cuentaReportes();

$reporte->setId($id);
$reporte->setEmail($post->email);
$reporte->setCotenido($post->contenido);
$reporte->save();
header("Location:" . Reporte::baseurl() . "app/listaReporte.php");