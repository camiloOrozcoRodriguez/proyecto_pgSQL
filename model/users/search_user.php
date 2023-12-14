<?php
    require_once("../../controller/open_connection.php");

    $search = pg_escape_string($_POST['dataObjetoSearch']['nombres']);
    
    $querySearch = "SELECT * FROM tbl_usuarios WHERE nombres LIKE '$search%';";
    $result = pg_query($dbconn, $querySearch);
    
    if(!$result){
        print "Error en la consulta: " .pg_last_error($dbconn);
    }

    $json = array();
    while($row = pg_fetch_assoc($result)){
        $json[] = array(
            'id' => $row['id'],
            'nombres' => $row['nombres'],
            'apellidos' => $row['apellidos'],
            'correo' => $row['correo'],
            'telefono' =>$row['num_celular']

        );
    }
    $jsonString = json_encode($json);
    print $jsonString;

?>