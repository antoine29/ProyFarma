<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Lista</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <?php
        require_once "../models/User.php";
        $url;
        $id;
        $db = new Database;
        $user = new User($db);
        $users = $user->get();
        ?>
        <div class="container">
            <div class="col-lg-12">
                <h2 class="text-center text-primary">Users</h2>
                <div class="col-lg-1 pull-right" style="margin-bottom: 10px">
                    <a class="btn btn-info" href="<?php echo User::baseurl() ?>app/add.php">Add user</a>
                </div>

                <?php
                if( ! empty( $users ) )
                {
                ?>
                <table class="table table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach( $users as $user )
                    {
                    ?>
                        <tr>
                            <td><?php echo $user->id ?></td>
                            <td><?php echo $user->nombre ?></td>
                            <td><?php echo $user->lat ?></td>
                            <td><?php echo $user->long ?></td>
                            <td>
                                <?php
                                    $url=User::baseurl()."app/edit.php";
                                    $id=$user->id;
                                    //echo $url;
                                ?>
                                <a class="btn btn-info" href="<?php echo User::baseurl()?>app/edit.php?user=<?php echo $user->id ?>">
                                    Edit
                                </a> 
                                <a class="btn btn-info" href="<?php echo User::baseurl() ?>app/delete.php?user="<?php echo $user->id ?>">Delete</a>
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