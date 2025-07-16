<?php
include_once 'conexion.php';
if (isset($_POST['ingresar'])) {
    $ced=$_POST['ced'];
    $nom=$_POST['nom'];
    $ape=$_POST['ape'];
    $psw=$_POST['psw'];
    $int=0;
$sql="INSERT INTO usuariose (ID_USU,NOM_USU,APE_USU,INTENTO,PSW_USU)
VALUES ('$ced','$nom','$ape','$int','$psw')";
    $conn->query($sql);
    if (!$conn) {
        die(json_encode($conn->error()));
    }
    header("Location: login.php");
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
    <a href="login.php">volver</a>
    <h1>Registrar</h1>
    <form action="registro.php" method="POST">
        cedula: <input type="text" name="ced" id="ced">
        <br>
        nombre: <input type="text" name="nom" id="nom">
        <br>
      apellido: <input type="text" name="ape" id="ape">
      <br>
      Clave: <input type="text" name="psw" id="psw">
      <input type="submit" value="ingresar" name="ingresar">

    </form>
</body>
</html>