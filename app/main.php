<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Geolocalizacion de farmacias</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        
        <?php
        require_once "../models/Farmacia.php";
        require_once "../models/Medicamento.php";
        require_once "../models/Prescripcion.php";
        
        /*
        $db = new Database;
        $farmacia = new Farmacia($db);
        $farmacia->setId('este_es_un_id');
        $farmacias = $farmacia->get();
        */


        ?>

        <div class="col-lg-12">
            <h2 class="text-center text-primary"> Sistema de geolocalizacion de farmacias</h2>
        </div>   

        <div align="center">

            <a class="btn btn-info" href="<?php echo Farmacia::baseurl() ?>app/2listaFarmacia.php">
            Listar farmacias
            </a> 

            <a class="btn btn-info" href="<?php echo Medicamento::baseurl() ?>app/listaMedicamento.php">
                Listar medicamentos
            </a> 

            <a class="btn btn-info" href="<?php echo Prescripcion::baseurl() ?>app/listaPrescripcion.php">
            Listar prescripciones
            </a>

            
            
        </div>
        

        <div>

            <h3 class="text-primary">Medicamentos</h3>

            <table class="table table-striped">
                <tr>
                    <td>
                        <h5 class="text-primary">Busqueda por nombre del medicamento</h3>
                        <form action="<?php echo Medicamento::baseurl() ?>app/listaBuscaMedicamento.php" method='POST'>
                            <div class="form-group">
                                <input type="text" name="nombre" value="" class="form-control" id="nombre" placeholder="nombre del medicamento">
                            </div>

                            <input type="submit" name="submit" class="btn btn-default" value="Buscar medicamento" />
                        </form>
                    </td>

                    <td>
                        <h5 class="text-primary">Busqueda de medicamento en farmacias</h3>
                        <form action="<?php echo Medicamento::baseurl() ?>app/listaBuscaMedsEnFarmas.php" method='POST'>
                            <div class="form-group">
                                <input type="text" name="nombre" value="" class="form-control" id="nombre" placeholder="nombre del medicamento">
                            </div>

                            <input type="submit" name="submit" class="btn btn-default" value="Buscar medicamento en farmacias" />
                        </form>
                    </td>
                    
                </tr>    

            </table>

        </div>

        <div>
            
            <h3 class="text-primary"> Prescripciones</h3>

             <table class="table table-striped">
                <tr>
                    <td>
                        <h5 class="text-primary">Buscar prescripcion por el nombre del doctor</h3>
                        <form action="<?php echo Farmacia::baseurl() ?>app/listaBuscaPresPorDoctor.php" method='POST'>
                            
                            <div class="form-group">
                                <input type="text" name="nombredoctor" value="" class="form-control" id="nombredoctor" placeholder="nombre del doctor">
                            </div>

                            <input type="submit" name="submit" class="btn btn-default" value="Buscar prescripciones" />

                        </form>
                    </td>

                    <td>
                        <h5 class="text-primary">Buscar prescripcion por el nombre del paciente</h3>
                        <form action="<?php echo Farmacia::baseurl() ?>app/listaBuscaPresPorPaciente.php" method='POST'>
                            
                            <div class="form-group">
                                <input type="text" name="nombrepaciente" value="" class="form-control" id="nombrepaciente" placeholder="nombre del paciente">
                            </div>

                            <input type="submit" name="submit" class="btn btn-default" value="Buscar prescripciones" />

                        </form>
                    </td>

                    <td>
                        <h5 class="text-primary">Buscar prescripcion por el nombre del establecimiento</h3>
                        <form action="<?php echo Farmacia::baseurl() ?>app/listaBuscaPresPorEstablecimiento.php" method='POST'>
                            
                            <div class="form-group">
                                <input type="text" name="nombreestablecimiento" value="" class="form-control" id="nombreestablecimiento" placeholder="nombre del establecimiento">
                            </div>

                            <input type="submit" name="submit" class="btn btn-default" value="Buscar prescripciones" />

                        </form>
                    </td>

                </tr>

                <tr>
                    <td>
                        <h5 class="text-primary">Buscar prescripcion que incluyan el medicamento</h3>
                        <form action="<?php echo Farmacia::baseurl() ?>app/listaBuscaPresPorEstablecimiento.php" method='POST'>         
                            
                            <div class="form-group">
                                <input type="text" name="nombreestablecimiento" value="" class="form-control" id="nombreestablecimiento" placeholder="nombre del establecimiento">
                            </div>

                            <input type="submit" name="submit" class="btn btn-default" value="Buscar prescripciones" />

                        </form>
                        
                    </td>
                </tr>
            </table> 

        </div>

        <div>

            <h3 class="text-primary">Farmacias</h3>

            <table class="table table-striped">
                <tr>
                    <td>
                        <form action="<?php echo Farmacia::baseurl() ?>app/listaBuscaFarmacia.php" method='POST'>
                            
                            <div class="form-group">
                                <input type="text" name="idfarmacia" value="" class="form-control" id="idfarmacia" placeholder="Id">
                            </div>

                            <input type="submit" name="submit" class="btn btn-default" value="Buscar farmacia" />

                        </form>
                    </td>
                </tr>
            </table>   

        </div>


    </body>
</html>