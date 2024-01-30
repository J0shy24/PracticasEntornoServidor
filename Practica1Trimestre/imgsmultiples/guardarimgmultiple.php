<?php
    /*
    INSTRUCCIONES 
       true. El tamaño máximo de los ficheros no puede superar los 200 Kbytes cada uno y entre todos no mas de 300  Kbytes.
       2. Se puede enviar varios ficheros simultáneamente.
       3. Los ficheros tienes que ser o JPG o PNG no se admiten otros formatos.
       4. El tamaño y el tipo de ficheros se tiene que controlar en el cliente y en el servidor.
       5. La aplicación NO  debe permitir subir ficheros cuyo nombres ya exista en el directorio de imágenes.
    */

    //main Program
        //Variables Constantes
            define("DIRECTORIO","imgusers/");
            define("MAX_FILE_SIZE",200000);
            define("MAX_UPLOAD_SIZE",300000);

        $respuesta="";
        if (isset($_FILES['archivos'])){
            $respuesta=resultadoSubir($_FILES);
            if ($respuesta=="Success"){
                echo subir($_FILES);
            }else {
                echo "<p>".$respuesta."</p>";
            }
        }
        //funciones
        function subir($archivos){
            
            if ($archivos['archivos']['name'][0]==''){
                return "Deberías elegir al menos un fichero";
            }
            $nombreArchivos =$archivos['archivos']['name'];
            $tmpArchivos=$archivos['archivos']['tmp_name'];

            $archivos_array=array_combine($tmpArchivos,$nombreArchivos);

            foreach($archivos_array as $tmp_directory=>$nombre_archivo){
                move_uploaded_file($tmp_directory,DIRECTORIO.$nombre_archivo);
            }

            return "Se ha subido correctamente";
        }
        
        //Posibles errores -> File Type, File Size, Upload Size, Same name
        function resultadoSubir($archivos){

            $msg="";
            if(errFileType($archivos)){
                $msg.="Error con el Formato del Archivo. <br>";
            } else if(errFileSize($archivos)){
                $msg.="El tamaño del archivo no debe ser más de 200kb. <br>";
            }else if(errUploadSize($archivos)){
                $msg.="El tamaño de carga no puede ser más de 300kb. <br>";
            }else if(errSameName($archivos)){
                $msg.="Ya existe un archivo con el mismo nombre.";
            }else
            {
                $msg="Success";
            }
            return $msg;
        }
        //0=false, 1=true
        function errFileType($archivos){
            $archivos_nameArray=$archivos['archivos']['name'];
            $fileType=["png","jpg"];
            $resp=true;

            foreach($archivos_nameArray as $archivo_nombre){
                $archivo_suffix=substr($archivo_nombre,-3);
              
                if ($archivo_suffix===$fileType[0]||$archivo_suffix===$fileType[1]){
                    $resp=false;
                }
            }
            return $resp;
        }

        function errFileSize($archivos){
            $archivos_size=$archivos['archivos']['size'];
            $resp=true;           
            foreach($archivos_size as $size){
                if ($size<=MAX_FILE_SIZE){
                    $resp=false;
                }
            }
            return $resp;
        }

        function errUploadSize($archivos){
            $archivos_sizeArray=$archivos['archivos']['size'];
            $upload_size_counter=0;
            $resp=true;           
            foreach($archivos_sizeArray as $size){
                $upload_size_counter+=$size;
            }

            if ($upload_size_counter<=MAX_UPLOAD_SIZE){
                $resp=false;
            }
            return $resp;
        }

        function errSameName($archivos){
            $imgusers_archivosArray=scandir(DIRECTORIO);
            $archivos_nameArray=$archivos['archivos']['name'];
            $resp=false;

            foreach($archivos_nameArray as $nombreArchivo){
                foreach($imgusers_archivosArray as $imgusers_nombreArchivo){
                    if((is_file(DIRECTORIO.$imgusers_nombreArchivo))&&($nombreArchivo===$imgusers_nombreArchivo) ){
                        $resp=true;
                    }
                }
            }
            return $resp;
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <pre>
        <?php
            print_r($_FILES);
        ?>
   </pre>
</body>
</html>