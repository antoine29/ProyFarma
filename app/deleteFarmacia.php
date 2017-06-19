<?php
require_once "../models/Farmacia.php";
$db = new Database;
$farmacia = new Farmacia($db);
$id = filter_input(INPUT_GET, 'farmacia', FILTER_VALIDATE_INT);

//echo " LLEGO " . $id;


if( is_int($id) )
{
    $farmacia->setId($id);
    $farmacia->delete();
    //echo "ENTRO";
}
else{
	//echo "NO ENTRO";	
}


header("Location:" . Farmacia::baseurl() . "app/listaFarmacia.php");


