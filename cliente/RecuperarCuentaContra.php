<?php
include_once('conexionK.php');


if($_SERVER['REQUEST_METHOD']=='POST'){
    $Correo=$_POST['Correo'];
    $Contrasena=$_POST['Contrasena'];
    //hara la consulta del correo electronico
   $sql = "SELECT Correo, Contrasena FROM cliente WHERE Correo = '$Correo'";

   if($Correo== '' || $Contrasena == ''){        
        echo 'Ingrese todos los datos correctamente';
    }else{
        $hashC = password_hash($Contrasena, PASSWORD_DEFAULT);
            $modificarC = "UPDATE cliente SET Contrasena = '$hashC' WHERE  Correo = '$Correo'";
             if(mysqli_query($Conexion,$modificarC)){
                echo 'Contraseña restablecida';
            }else{
                 echo 'error de registro' .$Correo." ".$Contrasena;
            }
    }
     $Conexion->close(); 
}else{
    echo 'Error verifique su conexión a internet';
}


?>