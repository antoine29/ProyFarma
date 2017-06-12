<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar farmacia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <?php
    require_once "../models/Farmacia.php";
    $id = filter_input(INPUT_GET, 'farmacia', FILTER_VALIDATE_INT);
    if( ! $id )
    {
        header("Location:" . Farmacia::baseurl() . "app/listaFarmacia.php");
    }
    $db = new Database;
    $newFarmacia = new Farmacia($db);
    $newFarmacia->setId($id);
    $farmacia = $newFarmacia->get();
    $newFarmacia->checkFarmacia($farmacia);
    ?>
    <div class="container">
        <div class="col-lg-12">
            <h2 class="text-center text-primary">Editar farmacia <?php echo $farmacia->nombre ?></h2>
            <form action="<?php echo Farmacia::baseurl() ?>app/updateFarmacia.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="" class="form-control" id="nombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="direccion" name="direccion" value="" class="form-control" id="direccion" placeholder="Direccion">
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="telefono" name="telefono" value="" class="form-control" id="telefono" placeholder="Telefono">
                </div>
                <div class="form-group">
                    <label for="latitud">Latitud</label>
                    <input type="latitud" name="latitud" value="" class="form-control" id="latitud" placeholder="Latitud">
                </div>
                <div class="form-group">
                    <label for="longitud">Longitud</label>
                    <input type="longitud" name="longitud" value="" class="form-control" id="longitud" placeholder="Longitud">
                </div>
                <input type="hidden" name="idfarmacia" value="<?php echo $farmacia->idfarmacia ?>" />
                <input type="submit" name="submit" class="btn btn-default" value="Actualizar farmacia" />
            </form>
        </div>
    </div>
</body>
</html>