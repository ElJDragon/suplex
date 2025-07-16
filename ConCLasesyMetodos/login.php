<?php
include_once 'conexion.php';

$intento = null;

if (isset($_POST['ingresar'])) {
    $sql="SELECT * FROM usuariose";
    $rs=$conn->query($sql);
    $user=$_POST['user'];
    $psw=$_POST['psw'];
    $encontrado = false;

    while ($row=$rs->fetch_assoc()) {
        if ($row['ID_USU']==$user && $psw==$row['PSW_USU']) {
            $encontrado = true;
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['nombre'] = $row['NOM_USU'];
            $_SESSION['apellido'] = $row['APE_USU'];

            if ($user=='admin') {
                header("Location: Admin.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        }
    }
    if (!$encontrado) {
        $intento = false;
    }
}

if (isset($_POST['registro'])) {
    header("Location: registro.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="POST">
    cédula: <input type="text" name="user" id="user">
    <br>
    clave: <input type="password" name="psw" id="psw">
    <br>
    <button type="submit" name="ingresar">Ingresar</button>
</form>

<?php
if ($intento === false) {
    echo("<h2>Usuario o contraseña incorrectos.</h2>");
    echo("<h2>Si no tiene usuario, registrese.</h2>");
}
?>

<form action="login.php" method="POST">
    <button type="submit" name="registro">Registro</button>
</form>

</body>
</html>