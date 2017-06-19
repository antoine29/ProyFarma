<?php

	require_once "../models/Farmacia.php";
	require_once "../models/Medicamento.php";

	$db = new Database;

	$m = new Medicamento($db);
	$f = new Farmacia($db);

	$n="hola";

	$f->setId(99);
	$f->setNombre($n);

	echo "es la prueba " . $f->getId();


?>
