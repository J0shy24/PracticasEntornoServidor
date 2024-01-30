<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v8.2.0/ol.css">
    <style>
        .map,#map{
            height:100%;
            width:100%;
            margin: 0;
        }

            html, body{
            height: 100%;
            width: 100%;
        }

        #mapContainer{
            height: 200px;
            width: 500px;
            margin:0;
            padding: 0;
        }
        
    </style>
    
</head>
    <body>
        <?php
        //IP-API para la bandera y el mapa.
                    $json_data=file_get_contents("http://ip-api.com/json/$cli->ip_address?fields=57538");
                    $data=json_decode($json_data,true); 
                    $lat=0;
                    $lon=0;
                    if(isset($data['lat'])&&isset($data['lon'])){
                    $lat=$data['lat'];
                    $lon=$data['lon'];
                    }
                    $msg="";
                    if(isset($data['message'])){
                    $msg=$data['message'];
                    }
                    $status=$data['status'];
                    $pais="";
                    if(isset($data['countryCode'])){
                    $pais=$data['countryCode'];
                    }

        ?>
        <hr>
        <button onclick="location.href='./'" > Volver </button>
        <br><br>
        <form>
        <table>
        <tr><td>id:</td> 
        <td><input type="number" name="id" value="<?=$cli->id ?>"  readonly > </td>
        <td rowspan="7"><?=mostrarFoto($cli->id)?></td> 
        <td rowspan="7"><?=mostrarBandera($pais,$status,$msg)?></td> 
        <td rowspan="7" id="mapContainer"><?php
                 if($lat==0&&$lon==0){?>
                    Locación no disponible
                <?php }else{?>
                    <div id="map" class="map"></div>
             <?php   }
             ?>
        </td> 
        <tr><td>first_name:</td> 
        <td><input type="text" name="first_name" value="<?=$cli->first_name ?>" readonly > </td></tr>
        </tr>
        <tr><td>last_name:</td> 
        <td><input type="text" name="last_name" value="<?=$cli->last_name ?>" readonly ></td></tr>
        </tr>
        <tr><td>email:</td> 
        <td><input type="email" name="email" value="<?=$cli->email ?>"   readonly  ></td></tr>
        </tr>
        <tr><td>gender</td> 
        <td><input type="text" name="gender" value="<?=$cli->gender ?>" readonly ></td></tr>
        </tr>
        <tr><td>ip_address:</td> 
        <td><input type="text" name="ip_address" value="<?=$cli->ip_address ?>" readonly ></td></tr>
        </tr>
        <tr><td>telefono:</td> 
        <td><input type="tel" name="telefono" value="<?=$cli->telefono ?>" readonly ></td></tr>
        </tr>
        
        <input type="hidden" value=<?=$lon?> id="lon"/>
        <input type="hidden" value=<?=$lat?> id="lat"/>

        </table>
        </form>
        
        <form>
        <input type="hidden"  name="id" value="<?=$cli->id ?>">
        <button type="submit" name="nav-detalles" value="Anterior"> Anterior << </button>
        <button type="submit" name="nav-detalles" value="Siguiente"> Siguiente >> </button>
        <button type="submit" name="nav-detalles" value="Imprimir">Imprimir</button>
        </form>
        
        <script src="https://cdn.jsdelivr.net/npm/ol@v8.2.0/dist/ol.js"></script>
        <script type="text/javascript">
                //MEJORA 10 MAPA
                //variables elementos
                let lat=parseFloat(document.getElementById("lat").value.trim());
                    let long=parseFloat(document.getElementById("lon").value.trim());
                    console.log(long+" | "+typeof(long)+" | "+lat+" | "+typeof(lat));
                var map=new ol.Map({
                    target: 'map',
                    layers: [
                        new ol.layer.Tile(
                        {
                            source: new ol.source.OSM()
                        }
                        )
                    ],
                    view: new ol.View({
                        center: ol.proj.fromLonLat([long,lat]),
                        zoom: 7
                    })
                })

                const marker = new ol.layer.Vector({
                    source: new ol.source.Vector({
                        features: [
                            new ol.Feature({
                                geometry: new ol.geom.Point(
                                    ol.proj.fromLonLat([long,lat])
                                )
                            })
                        ]
                    }),
                    style: new ol.style.Style({
                        image: new ol.style.Icon({
                            scale:0.05,
                            offset:[-20,-20],
                            src: 'app/uploads/location-pointer.png',
                            anchor:[0.5,1]
                        })
                    })
                })

                map.addLayer(marker)
                </script> 
    </body>
</html>


