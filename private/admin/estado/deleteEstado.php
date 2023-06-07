<?php

    if(isset($_GET['id'])){

        $id = $_GET['id'];
        echo 'Hemos recogido el valor ' . $id;

        require_once('DatabaseEstado.php');
        $database = new DatabaseEstado();
        $database->delete('estado', $id);

        header('Location: indexEstado.php');

    }else{
        echo 'Error';
    }
?>