<?php

    if(isset($_GET['id'])){

        $id = $_GET['id'];
        echo 'Hemos recogido el valor ' . $id;

        require_once('DatabaseUsuarios.php');
        $database = new DatabaseUsuarios();
        $database->delete('usuarios', $id);

        header('Location: indexUsuarios.php');

    }else{
        echo 'Error';
    }

?>