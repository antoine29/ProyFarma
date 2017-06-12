<?php
require_once "../models/Medicamento.php";
if (empty($_POST['submit']))
{
      header("Location:" . Medicamento::baseurl() . "app/listaMedicamento.php");
      exit;
}

$args = array(
	'idmedicamento'	=> FILTER_VALIDATE_INT,
    'nombre'  => FILTER_SANITIZE_STRING,
    'descripcion'  => FILTER_SANITIZE_STRING,
    'dosis'  => FILTER_SANITIZE_STRING,
    'tipo'  => FILTER_SANITIZE_STRING,
);

$post = (object)filter_input_array(INPUT_POST, $args);

if( $post->idmedicamento === false )
{
    header("Location:" . Medicamento::baseurl() . "app/listaMedicamento.php");
}

$db = new Database;
$medicamento = new Medicamento($db);
$medicamento->setId($post->idmedicamento);
$medicamento->setNombre($post->nombre);
$medicamento->setDescripcion($post->descripcion);
$medicamento->setDosis($post->dosis);
$medicamento->setTipo($post->tipo);

$medicamento->update();
header("Location:" . Medicamento::baseurl() . "app/listaMedicamento.php");