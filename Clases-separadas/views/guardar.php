<?php
$host="localhost";
$user="root";
$psw="";
$bd="cuarto";

$conn=mysqli_connect($host,$user,$psw,$bd);
if (!$conn) {
    die(json_encode("Error".mysqli_connect_error()));
}
$resultado=0;
if (isset($_POST['nuevo'])) {
    $ced=$_POST['cedula'];
    $nom=$_POST['nombre'];
    $ape=$_POST['apellido'];
    $tel=$_POST['telefono'];
    $dir=$_POST['direccion'];
    $sql="INSERT INTO estudiantes (estCedula,estNombre,estApellido,estTelefono,estDireccion)
    VALUES ('$ced', '$nom','$ape',$tel,'$dir')";
    if(!$conn->query($sql)){
        die(json_encode("Error".$conn->Error()));
    }
    $resultado=1;
    
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
    <a href="index.php">volver</a>
    <form action="guardar.php" method="POST">
        cedula: <input type="text" name="cedula" id="cedula">
        <br>
        nombre: <input type="text" name="nombre" id="nombre">
        <br>
        apellido: <input type="text" name="apellido" id="apellido">
        <br>
        telefono: <input type="text" name="telefono" id="telefono">
        <br>
        direccion: <input type="text" name="direccion" id="direccion">
        <br>
        <input type="submit" value="nuevo" name="nuevo">
    </form>
    <?php if ($resultado==1) {
        echo("<a>agregado correctamente</a>");
    }else {
        echo("<a>No agregado </a>");
    } ?>
</body>
</html>