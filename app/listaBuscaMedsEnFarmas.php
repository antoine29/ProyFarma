<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Resultados</title>
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
        
        $medicamento->setNombre($post->nombre);

        $medicamentos = $medicamento->buscaMedicamentoEnFarmacias();

        //para el mapa

        $vecFarmaPHP = array();
        $nro;
        $comilla = 042;

        ?>
        <div class="container">
            <div class="col-lg-12">
                <h2 class="text-center text-primary">Resultados</h2>

                <?php
                    if( ! empty( $medicamentos ) ){
                ?>
                        <table class="table table-striped">
                            <tr>
                                <th>Medicamento</th>
                                <th>Tipo</th>
                                <th>Dosis</th>
                                <th>Descripcion</th>
                                <th>Farmacia</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                            </tr>
                            <?php foreach( $medicamentos as $medicamento ){ 

                                array_push($vecFarmaPHP, $medicamento);

                            ?>
                            <tr>
                                <td><?php echo $medicamento->nombre ?></td>
                                <td><?php echo $medicamento->tipo ?></td>
                                <td><?php echo $medicamento->dosis ?></td>
                                <td><?php echo $medicamento->descripcion ?></td>
                                <td><?php echo $medicamento->nombref ?></td>
                                <td><?php echo $medicamento->direccion ?></td>
                                <td><?php echo $medicamento->telefono ?></td>
                                
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

        <div id="map"> </div>

        <script type="text/javascript">

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

                    var n = <?php echo( chr(042) . $farma->nombref . chr(042) ); ?> ;
                    
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