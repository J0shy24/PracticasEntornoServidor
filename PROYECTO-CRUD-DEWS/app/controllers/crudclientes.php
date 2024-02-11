<?php

function crudBorrar ($id){    
    $db = AccesoDatos::getModelo();
    $resu = $db->borrarCliente($id);
    if ( $resu){
         $_SESSION['msg'] = " El usuario ".$id. " ha sido eliminado.";
    } else {
         $_SESSION['msg'] = " Error al eliminar el usuario ".$id.".";
    }

}

function crudTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
}
 
function crudAlta(){
    $db = AccesoDatos::getModelo();
    $cli = new Cliente();
    $orden= "Nuevo";
    include_once "app/views/formulario.php";
}

function crudDetalles($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    include_once "app/views/detalles.php";
}

function crudDetallesSiguiente($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $ordenacion=$_SESSION['orderedBy'];
    $data=$cli->$ordenacion;
    $cli=$db->getClienteSiguiente($ordenacion,$data);
    if($cli){
        include_once "app/views/detalles.php";
    }else{
        crudDetalles($id);
    }
    
}

function crudDetallesAnterior($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $ordenacion=$_SESSION['orderedBy'];
    $data=$cli->$ordenacion;
    $cli=$db->getClienteAnterior($ordenacion,$data);
    if($cli){
        include_once "app/views/detalles.php";
    }else{
        crudDetalles($id);
    }
}

//Mejora 7 Imprimir pdf
function crudDetallesImprimir($id){
     $db=AccesoDatos::getModelo();
     $cli=$db->getCliente($id);
    // para la bandera Problema de esto es que llama el api otra vez y solo hay limite de 45 llamadas por minuto.
    // No veo manera de poner el mapa junto con el pdf ya que necesita Javascript, y el mpdf no lo soporta.
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
    
    // para el pdf
    require_once "vendor/autoload.php";
    error_reporting(0); 


    $mpdf=new \Mpdf\Mpdf();
    $foto=mostrarFoto($cli->id);
    $bandera=mostrarBandera($pais,$status,$msg);
    $html="
        <h1>Detalles del Cliente</h1>
        <table style='border:1px solid black'>
            <tr style='border:1px solid black'>
                <td rowspan='9' style='border:1px solid black'>$foto</td> 
            </tr>
            <tr style='border:1px solid black'>
                <td rowspan='9' style='border:1px solid black'>$bandera</td> 
            </tr>
            <tr style='border:1px solid black'>
                <td style='border:1px solid black'>ID :</td>
                <td style='border:1px solid black'>$cli->id</td>
            </tr>
            <tr style='border:1px solid black'>
                <td style='border:1px solid black'>First Name :</td>
                <td style='border:1px solid black'>$cli->first_name</td>
            </tr>
            <tr style='border:1px solid black'>
                <td style='border:1px solid black'>Last Name :</td>
                <td style='border:1px solid black'>$cli->last_name</td>
            </tr>
            <tr style='border:1px solid black'>
                <td style='border:1px solid black'>Email :</td>
                <td style='border:1px solid black'>$cli->email</td>
            </tr>
            <tr style='border:1px solid black'>
                <td style='border:1px solid black'>Gender :</td>
                <td style='border:1px solid black'>$cli->gender</td>
            </tr>
            <tr style='border:1px solid black'>
                <td style='border:1px solid black'>IP Address :</td>
                <td style='border:1px solid black'>$cli->ip_address</td>
            </tr>
            <tr style='border:1px solid black'>
                <td style='border:1px solid black'>Telefono :</td>
                <td style='border:1px solid black'>$cli->telefono</td>
            </tr>
        </table>
    ";

    $pdfName="$cli->first_name$cli->last_name.pdf";
    $mpdf->WriteHTML($html);
    $mpdf->Output($pdfName,"I");  
}


function crudModificar($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $orden="Modificar";
    include_once "app/views/formularioModificar.php";
}

function crudModificarSiguiente($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $ordenacion=$_SESSION['orderedBy'];
    $data=$cli->$ordenacion;
    $cli=$db->getClienteSiguiente($ordenacion,$data);
    if($cli){
        include_once "app/views/formularioModificar.php";
        }else{
            crudModificar($id);
        }
}

function crudModificarAnterior($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $ordenacion=$_SESSION['orderedBy'];
    $data=$cli->$ordenacion;
    $cli=$db->getClienteAnterior($ordenacion,$data);
    if($cli){
        include_once "app/views/formularioModificar.php";
        }else{
            crudModificar($id);
        }
 }

function crudPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    // !!!!!! No se controlan que los datos sean correctos 
    $db = AccesoDatos::getModelo();
    $cli = new Cliente();
    $cli->id            =$_POST['id'];
    $cli->first_name    =$_POST['first_name'];
    $cli->last_name     =$_POST['last_name'];
    $cli->email         =$_POST['email'];	
    $cli->gender        =$_POST['gender'];
    $cli->ip_address    =$_POST['ip_address'];
    $cli->telefono      =$_POST['telefono'];
   

    $check=true;
    if(emailRepErrorModificar($cli->id,$cli->email)){
        $_SESSION['msg'] .=" Email duplicado ";
        $check=false;
    }

    if(!validoTelefono($cli->telefono)){
        $_SESSION['msg'] .=" Formato de telefono invalido ";
        $check=false;
    }

    if(!validoIP($cli->ip_address)){
        $_SESSION['msg'] .=" Formato de IP invalido ";
        $check=false;
    }

    if($_POST['first_name']==""||$_POST['last_name']==""){
        $_SESSION['msg'] .=" Es obligatorio rellenar los campos de nombres ";
        $check=false;
    }

    if ($check){
        subircambiarFoto($cli->id);
        $db->addCliente($cli);
        $_SESSION['msg'] = " El usuario ha sido creada";
    } else {
        $_SESSION['msg'] .= " Error al crear el usuario ";
    }
}

function crudPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $cli = new Cliente();

    $cli->id            =$_POST['id'];
    $cli->first_name    =$_POST['first_name'];
    $cli->last_name     =$_POST['last_name'];
    $cli->email         =$_POST['email'];	
    $cli->gender        =$_POST['gender'];
    $cli->ip_address    =$_POST['ip_address'];
    $cli->telefono      =$_POST['telefono'];
    $db = AccesoDatos::getModelo();

    //Check
    $check=true;
    if(emailRepErrorModificar($cli->id,$cli->email)){
        $_SESSION['msg'] .=" Email duplicado ";
        $check=false;
    }

    if(!validoTelefono($cli->telefono)){
        $_SESSION['msg'] .=" Formato de telefono invalido ";
        $check=false;
    }

    if(!validoIP($cli->ip_address)){
        $_SESSION['msg'] .=" Formato de IP invalido ";
        $check=false;
    }

    if($_POST['first_name']==""||$_POST['last_name']==""){
        $_SESSION['msg'] .=" Es obligatorio rellenar los campos de nombres ";
        $check=false;
    }

    if ($check){
        subircambiarFoto($cli->id);
        crudModificar($cli->id);
        $_SESSION['msg'] = " El usuario ha sido modificado";
    } else {
        $_SESSION['msg'] .= " Error al modificar el usuario ";
    }

}

//Check Email
function emailRepErrorNuevo($email){
    $db=AccesoDatos::getModelo();
    $cli=$db->getEmail($email);
    if($cli){
        return true;
    }else{
        return false;
    }
}

 function emailRepErrorModificar($id,$email){
    $resultado=true;
    $db=AccesoDatos::getModelo();
    $cli=$db->getEmail($email);
    //echo $id ." | ".$cli->id." | ".$cli->email;
    if($cli){
        if($id==$cli->id){
            $resultado=false;
        }else{
            $resultado= true;
        }
    }else{
        $resultado= false;
    }
    return $resultado;
 }

 //Formato telefono (xxx-xxx-xxx)
 function validoTelefono($telefono){
    $regex="/\d{3}[-]\d{3}[-]\d{4}/";
    return preg_match($regex,$telefono);
 }

 //Formato IP ()
 function validoIP($ip){
    $resu=false;
    //Generado por chatGPT el regex
    $regex='/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/';
    
    if(preg_match($regex,$ip)){
        $resu=true;
    }
    return $resu;
 }

//Bandera País MEJORA 6
function mostrarBandera($cc,$status,$msg){

    if($status=='fail'){
        return $msg;
    }else{
        $pais=strtolower($cc);
        return '<img src="https://flagpedia.net/data/flags/w580/'.$pais.'.webp"  style="width: 100px; height: 20%"/>';
    }
}
//Mostrar foto MEJORA 4
//Mira si existe el fichero con extension jpg,png,jpeg (en orden).
function mostrarFoto($id){
    $defaultname='00000000';
    $fotoName=substr($defaultname,0,strlen($defaultname)-strlen($id));
    $fotoName=$fotoName.$id;
    $fotoRutajpg="app/uploads/$fotoName.jpg"; 
    $fotoRutapng="app/uploads/$fotoName.png"; 
    $fotoRutajpeg="app/uploads/$fotoName.jpeg"; 

    if(file_exists($fotoRutajpg)){
        return "<img src='app/uploads/".$fotoName.".jpg' alt='foto cliente' style='width: 100px; height: 20%'>";
    } else if(file_exists($fotoRutapng)){
        return "<img src='app/uploads/".$fotoName.".png' alt='foto cliente' style='width: 100px; height: 20%'>";
    }else  if(file_exists($fotoRutajpeg)){
        return "<img src='app/uploads/".$fotoName.".jpeg' alt='foto cliente' style='width: 100px; height: 20%'>";
    }
    else{
        return "<img src='https://robohash.org/$fotoName' alt='foto robo' style='width: 100px; height: 20%'/>";
    }
}

function mostrarOrden($orden){
    if($_SESSION['orderedBy']==$orden){
        if($_SESSION['ordenAD']=='ASC'){
            return "<span> ↑ </span>";
        }else if ($_SESSION['ordenAD']=='DESC'){
            return "<span> ↓ </span>";
        }
    }

    return null;
}
//MEjora 8y9
function verificarUsuario($usu,$pw){
    $db = AccesoDatos::getModelo();
    $pass=password_verify($pw,$db->getPass($usu));
    $user = $db->getLogin($usu);


    return $user&&$pass;
}

function verificarRol($usu){
    $resultado=false;
    $db = AccesoDatos::getModelo();
    $user = $db->getRol($usu);

    if($user){
        $resultado=$user;
    }
    return $resultado;
}
//Hago nuevos usuarios para testCase de base de datos.
function nuevoUsuario(){
    $orden='NuevoUsuario';
    include_once "app/views/formularioNuevoUsuario.php";
}
//Alta de usuarios con la contraseña encryptado
function crudPostAltaUsuario(){
    $db=AccesoDatos::getModelo();
    $usu=$_POST['NuevoLogin'];
    $pw=$_POST['NuevoPass'];
    $passEncrypt=password_hash($pw,PASSWORD_DEFAULT);
    $rol=$_POST['NuevoRol'];
    if($db->addUsuario($usu,$passEncrypt,$rol)){
        $_SESSION['msg']="Usuario añadido <br>";
    }else{
        $_SESSION['msg']="Error de alta";
    }
}

//Subir fotos MEJORA 5
//Funcion que mueva y controla la foto subida.
function subircambiarFoto($id){

    
    //MaxFilesize
    $maxFileSize=$_POST['MAX_FILE_SIZE'];
    //Variables del fichero
    $fileName=$_FILES['foto']['name'];
    $fileTmpName=$_FILES['foto']['tmp_name']; //nombre de la foto en el lado servidor
    $fileType=$_FILES['foto']['type'];
    $fileSize=$_FILES['foto']['size'];

    //Como se llamará la foto
    $defaultname='00000000';
    $fotoName=substr($defaultname,0,strlen($defaultname)-strlen($id));
    $fotoName=$fotoName.$id;
    $ext=pathinfo($fileName,PATHINFO_EXTENSION);
    $fotoRuta="app/uploads/$fotoName.$ext";

    //Control de subida extension de imagen
    if($fileType=='image/png'||$fileType=='image/jpg'||$fileType=='image/jpeg'){
        //Control de subida mayor que 499kbs
        if($fileSize>$maxFileSize){
            $_SESSION['msg'].="Tamaño maximo del fichero : 500kb";
        }else{
            move_uploaded_file($fileTmpName,$fotoRuta);
        }
    }
}
