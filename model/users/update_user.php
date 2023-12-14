<?php
    require_once("../../controller/open_connection.php");

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $celular = $_POST['num_celular'];
            
            
            //valido si el correo es un correo: 
            if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
                print "el correo electronico es incorrecto.";
            }else{
                $update = "UPDATE tbl_usuarios SET nombres = '$nombres',
                apellidos = '$apellidos', correo = '$correo', num_celular = $celular
                WHERE id = $id";
                $editRegistro = pg_query($dbconn, $update);
                if($editRegistro){
                    print "Registro Actualizado con exito";
                }
            }


        }
    }    

?>