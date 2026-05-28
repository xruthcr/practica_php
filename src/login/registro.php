<?php
session_start();
require_once("../includes/conexion.php");

$message = "";
$message_type = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['contraseña'];
    $confirmar_password = $_POST['confirmar_contraseña'];
    if($password == $confirmar_password){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuario (nombre, correo, contraseña, tipo_usuario) VALUES ('$nombre', '$correo', '$hash', 2)";
        if(mysqli_query($conexion, $sql)){
            $_SESSION['usuario_id'] = mysqli_insert_id($conexion);
            $_SESSION['usuario_nombre'] = $nombre;
            header("Location: ../pages/dashboard.php");
            exit();
        } else {
            $message = "Error: " . mysqli_error($conexion);
            $message_type = "error";
        }
    } else {
        $message = "Las contraseñas no coinciden";
        $message_type = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/registro.css">
</head>
<body>
  <div class="rw">
    <div class="rc">
 
      <div >
        <form id="form-state" method="POST">
        <p class="eyebrow">Bienvenido</p>
        <h1 class="title">Crear cuenta</h1>
        <p class="subtitle">¿Ya tienes cuenta? <a href="./login.php">Inicia sesión</a></p>
 
        <?php if ($message != ""): ?>
        <div class="msg msg--<?php echo $message_type; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="field">
          <label class="lbl" for="username">Nombre de usuario</label>
          <input class="inp" type="text" id="nombre" name="nombre" placeholder="ej. ana_garcia" autocomplete="username" />
        </div>
 
        <div class="field">
          <label class="lbl" for="email">Correo electrónico</label>
          <input class="inp" type="email" id="correo" name="correo" placeholder="ana@ejemplo.com" autocomplete="email" />
        </div>
 
        <div class="field">
          <label class="lbl" for="password">Contraseña</label>
          <div class="pw-wrap">
            <input class="inp" type="password" id="password" name="contraseña" placeholder="Mínimo 8 caracteres" autocomplete="new-password" />
            <button class="eye-btn" id="toggle1" aria-label="Mostrar contraseña">
              <i class="ti ti-eye" aria-hidden="true"></i>
            </button>
          </div>
          <p class="hint" id="pw-hint"></p>
        </div>
 
        <div class="field">
          <label class="lbl" for="confirm">Confirmar contraseña</label>
          <div class="pw-wrap">
            <input class="inp" type="password" id="confirm" name="confirmar_contraseña" placeholder="Repite tu contraseña" autocomplete="new-password" />
            <button class="eye-btn" id="toggle2" aria-label="Mostrar contraseña">
              <i class="ti ti-eye" aria-hidden="true"></i>
            </button>
          </div>
          <p class="hint" id="confirm-hint"></p>
        </div>
 
        <div class="check-row">
          <input type="checkbox" id="terminos" />
          <label class="check-lbl" for="terminos">
            Acepto los <a href="#">términos de uso</a> y la <a href="#">política de privacidad</a>
          </label>
        </div>
 
        <button class="btn" id="submit-btn" type="submit">
          <i class="ti ti-user-plus" aria-hidden="true"></i>
          Crear cuenta
        </button>
      </div>
 
      <div id="success">
        <div class="sicon"><i class="ti ti-check" aria-hidden="true"></i></div>
        <p class="smsg">¡Cuenta creada con éxito!</p>
      </div>
 
    </div>
</form>
    
</body>
</html>