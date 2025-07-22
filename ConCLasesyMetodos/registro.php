<?php
include_once 'conexion.php';

if (isset($_POST['ingresar'])) {
    $ced=$_POST['ced'];
    $psw=$_POST['psw'];
    $nom=$_POST['nom'];
    $ape=$_POST['ape'];
    

$sql="INSERT INTO usuariose (ID_USU,PSW,NOM_USU,APE_USU)
VALUES ('$ced','$psw','$nom','$ape')";
$conn->query($sql);
 header("Location: login.php");
    exit();
}

if (isset($_POST['volver'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registro</title>
</head>
<body>
    <section>
        <form action="registro.php" method="POST">
            cedula: <input type="text" name="ced" id="ced">
            contrasenia: <input type="text" name="psw" id="psw">
            nombre: <input type="text" name="nom" id="nom">
            apellido: <input type="text" name="ape" id="ape">
            <input type="submit" value="ingresar" name="ingresar">
            <input type="submit" value="volver" name="volver">
        </form>
    </section>
</body>
</html>