<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar medicamento</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <?php
    require_once "../models/Medicamento.php";
    $id = filter_input(INPUT_GET, 'medicamento', FILTER_VALIDATE_INT);
    if( ! $id )
    {
        header("Location:" . Medicamento::baseurl() . "app/listaMedicamento.php");
    }
    $db = new Database;
    $newMedicamento = new Medicamento($db);
    $newMedicamento->setId($id);
    $medicamento = $newMedicamento->get();
    $newMedicamento->checkMedicamento($medicamento);
    ?>
    <div class="container">
        <div class="col-lg-12">
            <h2 class="text-center text-primary">Editar medicamento <?php echo $medicamento->nombre ?></h2>
            <form action="<?php echo Medicamento::baseurl() ?>app/updateMedicamento.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="" class="form-control" id="nombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="direccion">Descripcion</label>
                    <input type="descripcion" name="descripcion" value="" class="form-control" id="descripcion" placeholder="Descripcion">
                </div>
                <div class="form-group">
                    <label for="dosis">Dosis</label>
                    <input type="dosis" name="dosis" value="" class="form-control" id="dosis" placeholder="Dosis">
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <input type="tipo" name="tipo" value="" class="form-control" id="tipo" placeholder="Tipo">
                </div>
                <input type="hidden" name="idmedicamento" value="<?php echo $medicamento->idmedicamento ?>" />
                <input type="submit" name="submit" class="btn btn-default" value="Actualizar medicamento" />
            </form>
        </div>
    </div>
</body>
</html>