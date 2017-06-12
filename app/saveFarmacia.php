<?php
require_once "../models/Farmacia.php";
if (empty($_POST['submit']))
{
      header("Location:" . Farmacia::baseurl() . "app/listaFarmacia.php");
      exit;
}

$args = array(
	'idfarmacia'	=> FILTER_VALIDATE_INT,
    'direccion'  => FILTER_SANITIZE_STRING,
    'telefono'  => FILTER_SANITIZE_STRING,
    'latitud'  => FILTER_SANITIZE_STRING,
    'longitud'  => FILTER_SANITIZE_STRING,
    'nombre'  => FILTER_SANITIZE_STRING,
);

$post = (object)filter_input_array(INPUT_POST, $args);

$db = new Database;
$farmacia = new Farmacia($db);
$farmacia->setId($post->idfarmacia);
$farmacia->setDireccion($post->direccion);
$farmacia->setTelefono($post->telefono);
$farmacia->setLat($post->latitud);
$farmacia->setLong($post->longitud);
$farmacia->setNombre($post->nombre);
$farmacia->save();
header("Location:" . Farmacia::baseurl() . "app/listaFarmacia.php");