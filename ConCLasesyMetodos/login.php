<?php
include_once 'conexion.php';
$sql="SELECT * FROM usuariose";
$rs=$conn->query($sql);
$intento=null;
if (isset($_POST['ingresar'])) {
    $user=$_POST['user'];
    $psw=$_POST['psw'];
    
    while ($row=$rs->fetch_assoc()) {
        if ($user==$row['ID_USU'] && $psw==$row['PSW']) {
            session_start();
            $_SESSION['user']=$row['ID_USU'];
            $_SESSION['nombre']=$row['NOM_USU'];
            $_SESSION['apellido']=$row['APE_USU'];
            if ($user == 'admin') {
            $intento=true;

                header("Location: admin.php");
                exit();
            }else{
                $intento=true;
                header("Location: encuesta.php");
                exit();

            }

        }
    }
    $intento=false;
    header("Location: login.php");
}
if (isset($_POST['registrar'])) {
    header("Location: registro.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="POST">
        ususario: <input type="text" name="user" id="user">
        <br>
        password: <input type="text" name="psw" id="psw">
        <br>
        <input type="submit" value="ingresar" name="ingresar">
        <br>
        <br>
        <input type="submit" value="registrar" name="registrar">
    </form>
    <?php
    if ($intento==false) {
        echo("<h2> Contrasenia o usuario incorrecto </h2>");
        echo("<h2> si no tiene usuario registrse </h2>");
    }
    ?>
</body>
</html>