<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Listado de farmacias</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <?php
        require_once "../models/Farmacia.php";
        $db = new Database;
        $farmacia = new Farmacia($db);
        $farmacias = $farmacia->get();  
        ?>
        <div class="container">
            <div class="col-lg-12">
                <h2 class="text-center text-primary">Farmacias</h2>
                <div class="col-lg-1 pull-right" style="margin-bottom: 10px">
                    <a class="btn btn-info" href="<?php echo Farmacia::baseurl() ?>app/addFarmacia.php">Adicionar farmacia</a>
                </div>

                <?php
                if( ! empty( $farmacias ) )
                {
                ?>
                <table class="table table-striped">
                    <tr>
                        <th>idFarmacia</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Accciones</th>
                    </tr>
                    <?php foreach( $farmacias as $farmacia )
                    {
                    ?>
                        <tr>
                            <td><?php echo $farmacia->idfarmacia ?></td>
                            <td><?php echo $farmacia->nombre ?></td>
                            <td><?php echo $farmacia->telefono ?></td>
                            <td><?php echo $farmacia->lat ?></td>
                            <td><?php echo $farmacia->long ?></td>
                            <td>
                                <a class="btn btn-info" href="<?php echo Farmacia::baseurl() ?>app/editFarmacia.php?farmacia=<?php echo $farmacia->idfarmacia ?>">Editar
                                </a> 
                                <a class="btn btn-info" href="<?php echo Farmacia::baseurl() ?>app/deleteFarmacia.php?farmacia=<?php echo $farmacia->idfarmacia ?>">Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <?php
                }
                else
                {
                ?>
                <div class="alert alert-danger" style="margin-top: 100px">No hay registros </div>
                <?php
                }
                ?>
            </div>
        </div>
    </body>
</html>