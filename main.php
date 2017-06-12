<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistema de geolocalizacion de farmacias</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
    	<?php
        require_once "http://localhost/ProyFarma/models/Farmacia.php";
        $db = new Database;
        $farmacia = new Farmacia($db);
        $farmacias = $farmacia->get();
        ?>
        <div class="container">
            <div class="col-lg-12">
                <h2 class="text-center text-primary">Sistema de geolocalizacion de farmacias</h2>
            </div>
        </div>
        <table class="table table-striped">
        	<td>
        		<a class="btn btn-info" href="<?php echo Farmacia::baseurl() ?>app/editFarmacia.php?farmacia=<?php echo $farmacia->idfarmacia ?>">Buscar farmacia
                                </a> 
        		<a class="btn btn-info" href="http://localhost/ProyFarma/app/listaFarmacia.php">Listar farmacias
                                </a> 
        	</td>
        </table>
    </body>
</html>