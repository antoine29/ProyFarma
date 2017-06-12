<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Listado de prescripciones</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <?php
        require_once "../models/Prescripcion.php";
        $db = new Database;
        $prescripcion = new Prescripcion($db);
        $prescripciones = $prescripcion->get();  
        ?>
        <div class="container">
            <div class="col-lg-12">
                <h2 class="text-center text-primary">Prescripciones</h2>

                <?php
                if( ! empty( $prescripciones ) )
                {
                ?>
                <table class="table table-striped">
                    <tr>
                        <th>idPrescripcion</th>
                        <th>Fecha</th>
                        <th>Nombre Paciente</th>
                        <th>Nombre Doctor</th>
                        <th>Nombre Medicamento</th>
                        <th>Dosis</th>
                        <th>Nombre establecimiento</th>
                        
                    </tr>
                    <?php foreach( $prescripciones as $prescripcion )
                    {
                    ?>
                        <tr>
                            <td>
                                <?php echo $prescripcion->idprescripcion ?>
                            </td>
                            <td>
                                <?php echo $prescripcion->fecha ?>
                            </td>
                            <td>
                                <?php echo $prescripcion->nombrepaciente ?>
                            </td>
                            <td>
                                <?php echo $prescripcion->nombredoctor ?>
                            </td>
                            <td>
                                <?php echo $prescripcion->nombremedicamento ?>
                            </td>
                            <td>
                                <?php echo $prescripcion->dosis ?>
                            </td>
                            <td>
                                <?php echo $prescripcion->nombreestablecimiento ?>
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