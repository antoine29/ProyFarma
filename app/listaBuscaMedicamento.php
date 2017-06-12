<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Listado de Medicamentos</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <?php
        require_once "../models/Medicamento.php";


        if (empty($_POST['submit'])){
            header("Location:" . Medicamento::baseurl() . "app/listaMedicamento.php");
            exit;
        }

        $args = array(
            'nombre' => FILTER_VALIDATE_STR
        );

        $post = (object)filter_input_array(INPUT_POST, $args);

       /// echo $post->nombre;

        $db = new Database;
        $medicamento = new Medicamento($db);
        //$medicamento->setId(1);
        $medicamento->setNombre($post->nombre);

        //echo "LLEGO";
        //echo $medicamento->getNombre();


        $medicamentos = $medicamento->buscaNombre();

        ?>
        <div class="container">
            <div class="col-lg-12">
                <h2 class="text-center text-primary">Medicamento</h2>

                <?php
                    if( ! empty( $medicamentos ) ){
                ?>
                        <table class="table table-striped">
                            <tr>
                                <th>idMedicamento</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Dosis</th>
                                <th>Tipo</th>
                                <th>Accciones</th>
                            </tr>
                            <?php foreach( $medicamentos as $medicamento ){ ?>
                            <tr>
                                <td><?php echo $medicamento->idmedicamento ?></td>
                                <td><?php echo $medicamento->nombre ?></td>
                                <td><?php echo $medicamento->descripcion ?></td>
                                <td><?php echo $medicamento->dosis ?></td>
                                <td><?php echo $medicamento->tipo ?></td>
                                <td>
                                    <a class="btn btn-info" href="<?php echo Medicamento::baseurl() ?>app/editMedicamento.php?medicamento=<?php echo $medicamento->idmedicamento ?>">Editar </a> 
                                    <a class="btn btn-info" href="<?php echo Medicamento::baseurl() ?>app/deleteMedicamento.php?medicamento=<?php echo $medicamento->idmedicamento ?>">Eliminar </a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                <?php
                }
                else{
                    ?>
                        <div class="alert alert-danger" style="margin-top: 100px">No hay registros </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </body>
</html>