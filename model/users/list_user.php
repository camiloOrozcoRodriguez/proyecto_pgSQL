<?php
    // abrimos la conexion a la bd
    require_once("../../controller/open_connection.php");

    // sacamos todos los registros
    $queryList = "SELECT * FROM tbl_usuarios";
    $result = pg_query($dbconn, $queryList);

    //verificamos si la consulta es correcta 
    if($result){
        // este arreglo contendrá toda la info de la bd         
        $json = array();
        while($row = pg_fetch_assoc($result)){

            $json[] = array(
                "id" => $row['id'],
                "nombres" => $row['nombres'],
                "apellidos" => $row['apellidos'],
                "correo" => $row['correo'],
                "telefono" => $row['num_celular']
            );
        }

        // y luego es enviada desde el servidor hacia la vista (cliente)
        print json_encode($json);
    }else{
        echo "Error en la consulta: " . pg_last_error($dbconn);
    }

?>