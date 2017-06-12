<?php
//	echo "llego";

	require_once "../models/Farmacia.php";

	$db = new Database;
	$farmacia = new Farmacia($db);
	$farmacias = $farmacia->get();
	
	header("Content-type: text/xml");
	
	echo '<markers>';
	// Iterate through the rows, printing XML nodes for each
	foreach( $farmacias as $farmacia ){
  	// Add to XML document node
  		echo '<marker ';
  		echo 'name="' . $farmacia->nombre . '" ';
  		echo 'address="' . $farmacia->direccion . '" ';
  		echo 'lat="' . $farmacia->lat . '" ';
  		echo 'lng="' . $farmacia->long . '" ';
  		echo 'type="' . $farmacia->telefono . '" ';
  		echo '/>';
	}

	// End XML file
	echo '</markers>';
	
?>