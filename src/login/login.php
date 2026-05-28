<?php session_start(); 
require_once("../includes/conexion.php");
$mensaje = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['contraseña'];

    $sql = "SELECT * FROM usuario WHERE nombre = '$usuario'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $user = mysqli_fetch_assoc($resultado);
        if (password_verify($password, $user['contraseña'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nombre'] = $user ['nombre'];
            header("Location: ../pages/dashboard.php");
            exit();
        } else {
            $mensaje = "Contraseña incorrecta";
        }
    } else {
        $mensaje = "Usuario no encontrado";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registro.css">
    <title>Document</title>
</head>
<body>
    <div class="rw">
    <div class="rc">
 
      <div >
        <form id="form-state" method="POST">
        <p class="eyebrow">Bienvenido</p>
        <h1 class="title">Inicia Sesion</h1>
        <p class="subtitle">¿Aun no tienes cuenta? <a href="./registro.php">Crear cuenta</a></p>
 
        <?php if ($mensaje != ""): ?>
        <div class="msg msg--error"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <div class="field">
          <label class="lbl" for="username">Nombre de usuario</label>
          <input class="inp" type="text" id="usuario" name="usuario" placeholder="ej. ana_garcia" autocomplete="username" />
        </div>
 
        <div class="field">
          <label class="lbl" for="password">Contraseña</label>
          <div class="pw-wrap">
            <input class="inp" type="password" id="contraseña" name="contraseña" placeholder="Mínimo 8 caracteres" autocomplete="new-password" />
            <button class="eye-btn" id="toggle1" aria-label="Mostrar contraseña">
              <i class="ti ti-eye" aria-hidden="true"></i>
            </button>
          </div>
          <p class="hint" id="pw-hint"></p>
        </div>
        <button class="btn" id="submit-btn" type="submit">
          <i class="ti ti-user-plus" aria-hidden="true"></i>
          Iniciar sesión
        </button>
      </div>
 
      <div id="success">
        <div class="sicon"><i class="ti ti-check" aria-hidden="true"></i></div>
        <h2 class="stitle">¡Sesión iniciada!</h2>
        <p class="smsg">Bienvenido de vuelta.<br>Has iniciado sesión correctamente.</p>
      </div>
 
    </div>
</form>
</body>
</html>