<?php

  session_start();

  if(isset($_SESSION['user_id'])){
    header('Location: /php-Login');
  }

  require 'reg.php';

  if(!empty($_POST['correo']) && !empty($_POST['password'])){
    $records = $conn->prepare('SELECT id, correo, password FROM datos WHERE correo=:correo');
    $records->bindParam(':correo', $_POST['correo']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
      $_SESSION['user_id'] = $results['id'];
      header("Location: /php-Login");
    }else{
      $message = ' Algo Salio Mal :/';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="Css/Inicio.css">
  <title > BioTires </title>
  <link rel="shortcut icon" href="img/plant.png" type="img/x-icon">


</head>
<body>
  <section class="form-register">

    <h4>¡ Bienvenido !</h4>
    <h4> Esperamos que Disfrutes tu Estancia. </h4>

    <?php if(!empty($message)):?>
    <p><?= $message ?></p>
    <?php endif;?>

    <form action="Biotires.php" method="POST">
    <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo">
    <input class="controls" type="password" name="password" id="correo" placeholder="Ingrese su Contraseña">

    <p> Unete a nosotros: </p>

    <div style="text-align: center;">
      <table border="0" style="margin: 0 auto;">
        <tr>
          <td>
            <img src="img/f66d49097e18978ddf46282c233040a9.png" alt="Facebook" width="50px" height="50px">
            <p><a href="http://facebook.com"> Facebook </a></p>
          </td>
          <td> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td>
            <img src="img/NuevoGmail-1.png" alt="gmail" width="50px" height="50px">
            <p><a href="https://accounts.google.com/signin/v2/identifier?continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&service=mail&sacu=1&rip=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin">Gmail</a></p>
          </td>
        </tr>
      </table>
    </div>
    
    <button class="botons" type="submit">Iniciar Sesión.</button>
    </form>

    
   
    <p><a href="Registro.php"> Registrarme </a></p>
  </section>

</body>
</html>