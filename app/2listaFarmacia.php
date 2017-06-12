<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Listado de farmacias</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">

        <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 80%;
            margin: 0;
            padding: 0;
        }
        </style>

    </head>

    <body>
        <?php
        require_once "../models/Farmacia.php";
        $db = new Database;
        $farmacia = new Farmacia($db);
        $farmacias = $farmacia->get(); 

         //para el mapa
        $vecFarmaPHP = array();
        $nro;
        $comilla = 042;

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
                        array_push($vecFarmaPHP, $farmacia);

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

        <div>
            <?php
                echo "--------------";
                $nro=count($vecFarmaPHP);

                /*
                echo $nro;         
                foreach ($vecFarmaPHP as $farma) {
                    echo $farma->idfarmacia . $farma->nombre . $farma->lat . $farma->long . $farma->telefono;
                }
                */


            ?>
        </div>

        <div id="map"> </div>

        <script type="text/javascript">

            var customLabel = {
                Monument: { label: 'Monument'},
                Park: { label: 'National Park' },
                Stadium: { label: 'Stadium'},
                Neighborhood: { label: 'Neighborhood'}
            };


            //objeto farmacia en JS
            function farmaciaJS(id, nom, lat, lon, tele) {
                this.idFarma = id;
                this.nomFarma = nom;
                this.latFarma = lat;
                this.lonFarma = lon;
                this.teleFarma = tele;
            }

            var vecFarmaJS = [];

            <?php
                foreach ($vecFarmaPHP as $farma) {
            ?>
                    var i = <?php echo( $farma->idfarmacia ); ?> ;

                    var n = <?php echo( chr(042) . $farma->nombre . chr(042) ); ?> ;
                    
                    var la = <?php echo( chr(042) . $farma->lat . chr(042) ); ?> ;

                    var lo = <?php echo( chr(042) . $farma->long . chr(042) ); ?> ;

                    var tel = <?php echo( chr(042) . $farma->telefono . chr(042) ); ?> ;

                    var f = new farmaciaJS(i, n, la, lo, tel);
                    
                  //  alert ('farmacia : ' + f.idFarma + " - " + f.nomFarma + " - " + f.latFarma + " - " + f.lonFarma + " - " + f.teleFarma);

                    vecFarmaJS.push(f);
            <?php        
                }
            ?>


            /*
            alert("elementos en el vector JS " + vecFarmaJS.length);

            for (var i = vecFarmaJS.length - 1; i >= 0; i--) {
                alert(vecFarmaJS[i].idFarma + vecFarmaJS[i].nomFarma + vecFarmaJS[i].latFarma + vecFarmaJS[i].lonFarma + vecFarmaJS[i].teleFarma);
            }

            alert('llego');
            */

            //hasta qui tengo un vector en JS con los datos de todas las farmacias listadas


            //aqui comienza el mapa

            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: new google.maps.LatLng(-16.4965409, -68.1362544), // la paz
                    zoom: 14
                });

                var infoWindow = new google.maps.InfoWindow;

                Array.prototype.forEach.call(vecFarmaJS, function(markerElem)
                {
                    var id = markerElem.idFarma.toString();
                    var nombre = markerElem.nomFarma;
                    var telefono = "telefono: " + markerElem.teleFarma;
                    var point = new google.maps.LatLng(
                        parseFloat(markerElem.latFarma),
                        parseFloat(markerElem.lonFarma)
                    );

                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                    strong.textContent = nombre;
                    infowincontent.appendChild(strong);
                    infowincontent.appendChild(document.createElement('br'));

                    var text = document.createElement('text');
                    text.textContent = telefono;
                    infowincontent.appendChild(text);

                    var marker = new google.maps.Marker({
                        map: map,
                        position: point,
                        label: id
                    });

                    marker.addListener('click', function() {
                        infoWindow.setContent(infowincontent);
                        infoWindow.open(map, marker);
                    });

                });
                
            }

        </script>

        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBh6BlR0s3eTsTjGdfTrDYhsTOYV8WDd2k&callback=initMap">
        </script>

    </body>
</html>