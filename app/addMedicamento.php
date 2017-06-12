<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Adicionar medicamento</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <?php
    require_once "../models/Medicamento.php";
    ?>
    <div class="container">
        <div class="col-lg-12">
            <h2 class="text-center text-primary">Adicionar medicamento</h2>
            <form action="<?php echo Medicamento::baseurl() ?>app/saveMedicamento.php" method="POST">
                <div class="form-group">
                    <label for="idmedicamento">ID</label>
                    <input type="text" name="idmedicamento" value="" class="form-control" id="idmedicamento" placeholder="Id">
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="" class="form-control" id="nombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
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
                <input type="submit" name="submit" class="btn btn-default" value="Guardar medicamento" />
            </form>
        </div>
    </div>
</body>
</html>