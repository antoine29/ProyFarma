<?php
require_once "../models/Medicamento.php";
$db = new Database;
$medicamento = new Medicamento($db);
$id = filter_input(INPUT_GET, 'medicamento', FILTER_VALIDATE_INT);

if( is_int($id) )
{
    $medicamento->setId($id);
    $medicamento->delete();
}
header("Location:" . Medicamento::baseurl() . "app/listaMedicamento.php");