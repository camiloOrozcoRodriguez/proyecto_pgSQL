<?php
    require_once("../../controller/open_connection.php");

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST['id'])){
            $id = $_POST['id'];

            $queryDelete = "DELETE FROM tbl_usuarios WHERE id = $id";
            $delete = pg_query($dbconn, $queryDelete);

            if($delete){
                print "Registro eliminado con exito";
            }else{
                print "ocurrio un error al eliminar el registro.";
            }
        }
    }    

?>