<?php

echo "llego";

/*
require_once "../models/Farmacia.php";

function parseToXML($htmlStr){
  $xmlStr=str_replace('<','&lt;',$htmlStr);
  $xmlStr=str_replace('>','&gt;',$xmlStr);
  $xmlStr=str_replace('"','&quot;',$xmlStr);
  $xmlStr=str_replace("'",'&#39;',$xmlStr);
  $xmlStr=str_replace("&",'&amp;',$xmlStr);
  return $xmlStr;
}



$db = new Database;
$farmacia = new Farmacia($db);
$farmacias = $farmacia->get(); 
*/



/*

foreach( $farmacias as $farmacia ){
  echo "----FARMACIA---";
  echo $farmacia->idfarmacia ; 
  echo $farmacia->nombre ;
  echo $farmacia->telefono ;
  echo $farmacia->lat ;
  echo $farmacia->long ;                          
  }

                    
//-----------------ok

*/

/*

header("Content-type: text/xml");
// Start XML file, echo parent node
echo '<markers>';
// Iterate through the rows, printing XML nodes for each
foreach( $farmacias as $farmacia ){
  // Add to XML document node
  echo '<marker ';
  echo 'name="' . parseToXML($farmacia->nombre) . '" ';
  echo 'address="' . parseToXML($farmacia->direccion) . '" ';
  echo 'lat="' . $farmacia->lat . '" ';
  echo 'lng="' . $farmacia->long . '" ';
  echo 'type="' . $farmacia->telefono . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';
*/

*/

/*
header("Content-type: text/xml");
echo '<markers>';
  echo "contenido";
echo '</markers>';
*/



?>
