<?php
require_once "../models/Farmacia.php";
$db = new Database;
$farmacia = new Farmacia($db);
$id = filter_input(INPUT_GET, 'farmacia', FILTER_VALIDATE_INT);

if( $id )
{
    $farmacia->setId($id);
    $farmacia->delete();
}
header("Location:" . Farmacia::baseurl() . "app/listaFarmacia.php");