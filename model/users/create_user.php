<?php
    require_once("../../controller/open_connection.php");

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        // verifico que no esten nulos
        if (isset($_POST['nombres'], $_POST['apellidos'], $_POST['correo'], $_POST['num_celular'])) {
            // almaceno la info en variables
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $celular = $_POST['num_celular'];

            
            // valido que el correo sea valido
            if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
                print "El correo electronico es incorrecto.";
            }else{
                // consulto si el telefono ya existe en la bd: 
                $queryVerificar = "SELECT COUNT(*) 
                FROM tbl_usuarios WHERE num_celular = '$celular'";
                $existeRegistro = pg_query($dbconn, $queryVerificar);
        
                if($existeRegistro){
                    $row = pg_fetch_row($existeRegistro);
                    $numFilas = $row[0];

                    if($numFilas > 0){
                        echo "Este numero de telefono ya se encuentra registrado.";
                    }else{
                        // en caso de que no se encuentre registrado se inserta a la bd
                        $queryCreate = "INSERT INTO tbl_usuarios 
                        (nombres,apellidos,correo,num_celular) 
                        VALUES ('$nombres', '$apellidos', '$correo', $celular)";
                        $insert = pg_query($dbconn, $queryCreate);

                        if($insert){
                            print "Se insertó con exito el cliente.";
                        }
                    }
                }
            }
        }    
    }
?>