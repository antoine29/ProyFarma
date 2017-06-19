<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar farmacia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <?php

    //echo "llego";

    require_once "../models/Farmacia.php";
    $id = filter_input(INPUT_GET, 'farmacia', FILTER_VALIDATE_INT);

//    echo "LLEGO ID " . $id;

    if( ! $id )
    {
        header("Location:" . Farmacia::baseurl() . "app/listaFarmacia.php");
    }

    $direccion;
    $idfarmacia;    //columnas de la tabla
    $telefono;
    $lat;
    $long;
    $nombre;

    $db = new Database;
    $newFarmacia = new Farmacia($db);
    
    $newFarmacia->setId($id);

    $farmacia = $newFarmacia->get();

   // echo $farmacia->getId() . $farmacia->getNombre() . $farmacia->getLat() . "  THIAS";

    if( ! empty( $farmacia ) ){
        foreach( $farmacia as $f ){
            $idfarmacia=$f->idfarmacia;
            $nombre=$f->nombre;
            $direccion=$f->direccion;
            $telefono=$f->telefono;
            $lat=$f->lat;
            $long=$f->long;
        }
    }
    else{
        echo "NADA";     
    }

    //echo $idfarmacia . $nombre . $telefono . $lat . $direccion;
    
    //$newFarmacia->checkFarmacia($farmacia);    
    
    ?>
    <div class="container">
        <div class="col-lg-12">
            <h2 class="text-center text-primary">Editar farmacia</h2>
            <form action="<?php echo Farmacia::baseurl() ?>app/updateFarmacia.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="<?php echo $nombre ?>" class="form-control" id="nombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="direccion" name="direccion" value="<?php echo $direccion ?>" class="form-control" id="direccion" placeholder="Direccion">
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="telefono" name="telefono" value="<?php echo $telefono ?>" class="form-control" id="telefono" placeholder="Telefono">
                </div>
                <div class="form-group">
                    <label for="latitud">Latitud</label>
                    <input type="latitud" name="latitud" value="<?php echo $lat ?>" class="form-control" id="latitud" placeholder="Latitud">
                </div>
                <div class="form-group">
                    <label for="longitud">Longitud</label>
                    <input type="longitud" name="longitud" value="<?php echo $long ?>" class="form-control" id="longitud" placeholder="Longitud">
                </div>
                <input type="hidden" name="idfarmacia" value="<?php echo $idfarmacia ?>" />
                <input type="submit" name="submit" class="btn btn-default" value="Actualizar farmacia" />
            </form>
        </div>
    </div>
</body>
</html>