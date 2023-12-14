<?php

    // establecemos una conexion con el servidor postgreSQL
    $dbconn = pg_connect("host=localhost port=5432 dbname=crud_pgSQL user=postgres password=admin options='--client_encoding=UTF8'");

    // Revisamos el estado de la conexion en caso de errores. 
    if(!$dbconn) {
        echo "Error al conectar a la base de datos: ".pg_last_error()."\n";
    } else {
        // echo "Conexión exitosa: ".pg_host($dbconn)."\n";
    }

?>

