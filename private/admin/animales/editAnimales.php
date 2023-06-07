<?php
    session_start();

    if(isset($_SESSION['pepito'])){
        $sesion = '<a href="../../../auth/login/logout.php"><i class="fas fa-sign-out-alt"></i></a>';
    }else{
        $sesion = '<a href="../../../auth/login/login.php"><i class="fas fa-user"></i></a>';
    }

    if(isset($_GET['id'])){

        $id = $_GET['id'];

        require_once ('DatabaseAnimales.php');
        $database = new DatabaseAnimales();
        $animal = $database->getId($id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Eugenia Ramos Santos y Andrea Meléndez Rodríguez">
    <meta name="description" content="Página de la protectora Aociación ASAL, animales a salvo">
    <meta name="keywords" content="Animales, adopción, rescate, asociación, perros, gatos, conejos, acogida, callejero">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x.icon" href="../../../img/logos/icono.ico">
    <link rel="stylesheet" href="../create.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Animales - Admin | ASAL</title>
</head>
<body>
    <header>
        <section id="header">
            <div>
                <p class="contact">+34 913 746 924 <br>asalasociacion@gmail.com</p>
            </div>
            <div>
                <a href="../../../public/index/index.php"><img id="logo" src="../../../img/logos/logo2.png" alt="logo ASAL"></a>
            </div>
            <div>
                <p><input type="text"><i class="fas fa-search"></i><a href="#fo"><i class="fas fa-phone"></i></a><?php echo $sesion; ?></p>
            </div>
        </section>
    </header>
    
    <h1>Actualizar animal</h1>
    <form action="updateAnimales.php" method="POST">
        <input type="hidden" value="<?php echo $animal['id']?>" name="id">
        <label id="" name="">Nombre: </label>
        <input type="text" value="<?php echo $animal['nombre']?>" name="nombre">
        <br>
        <br>
        <label id="" name="">Edad: </label>
        <input type="text" value="<?php echo $animal['edad']?>" name="edad">
        <br>
        <br>
        <label id="" name="">Fecha de nacimiento: </label>
        <input type="text" value="<?php echo $animal['fecha_nacimiento']?>" name="fecha_nacimiento">
        <br>
        <br>
        <label id="" name="">Fecha de entrada: </label>
        <input type="text" value="<?php echo $animal['fecha_entrada']?>" name="fecha_entrada">
        <br>
        <br>
        <label id="" name="">Id del estado: </label>
        <input type="text" value="<?php echo $animal['estado_id']?>" name="estado_id">
        <br>
        <br>
        <label id="" name="">Id del usuario: </label>
        <input type="text" value="<?php echo $animal['usuarios_id']?>" name="usuarios_id">
        <br>
        <br>
        <label id="" name="">Id del tamaño: </label>
        <input type="text" value="<?php echo $animal['tamanio_id']?>" name="tamanio_id">
        <br>
        <br>
        <label id="" name="">Id del sexo: </label>
        <input type="text" value="<?php echo $animal['sexo_id']?>" name="sexo_id">
        <br>
        <br>
        <label id="" name="">Id del tipo: </label>
        <input type="text" value="<?php echo $animal['tipo_id']?>" name="tipo_id">
        <br>
        <br>
        <label id="" name="">Descripción: </label>
        <input type="text" value="<?php echo $animal['descripcion']?>" name="descripcion">
        <br>
        <br>
        <button type="submit">Enviar</button>
    </form>
</body>

</body>
</html>
</html>