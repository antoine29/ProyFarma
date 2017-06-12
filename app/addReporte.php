<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Adicionar reporte</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <?php


    require_once "../models/Reporte.php";

    ?>
    <div class="container">
        <div class="col-lg-12">
            <h2 class="text-center text-primary">Adicionar reporte</h2>

            <form action="<?php echo Reporte::baseurl() ?>app/saveReporte.php" method="POST">
                
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" name="email" value="" class="form-control" id="email" placeholder="Email">
                </div>
                
                <div class="form-group">
                    <label for="email">Reporte *</label>
                    <textarea type="text" name="contenido" rows="5" cols="30" class="form-control" id="contenido"></textarea>
                </div>

                <input type="submit" name="submit" class="btn btn-default" value="Reportar" />
            </form>
        </div>
    </div>
</body>
</html>