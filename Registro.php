<?php
  require 'reg.php';

  $message='';

  if(!empty($_POST['nombre']) || !empty($_POST['apellido']) || !empty($_POST['correo']) || !empty($_POST['password'])){
    $sql = "INSERT INTO datos (Nombre, Apellido, Correo, Password) VALUES (:nombre, :apellido, :correo, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre',$_POST['nombre']);
    $stmt->bindParam(':apellido',$_POST['apellido']);
    $stmt->bindParam(':correo',$_POST['correo']);
    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
    $stmt->bindParam(':password',$password);

    if($stmt->execute()){
      $message = 'Successfully';
    }else{
      $message = 'Not Successfully';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="CSS/style.css">
  <title>Formulario Registro</title>
  <link rel="shortcut icon" href="img/plant.png" type="img/x-icon">
</head>

<body>

  <?php if(!empty($message)):?>
  <p><?= $message ?></p>
  <?php endif;?>

  <section class="form-register">
    <h4>Formulario Registro</h4>

    <span></span>

    <form action="Registro.php" method="POST">
    <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese su Nombre">
    <input class="controls" type="text" name="apellido" id="apellido" placeholder="Ingrese su Apellido">
    <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo">
    <input class="controls" type="password" name="password" id="password" placeholder="Ingrese su Contraseña">
    <p>Estoy de acuerdo con <a href="#">Terminos y Condiciones</a></p>
    <input class="botons" type="submit" value="Submit" >
    <p><a href="Login.php">¿Ya tengo Cuenta?</a></p>
    </form>
    
  </section>

</body>
</html>
