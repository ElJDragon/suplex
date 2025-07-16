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
if (isset($_POST['borrar'])) {
    $ced=$_POST['cedula'];
    $sql="DELETE FROM estudiantes WHERE estCedula='$ced' ";
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
    <form action="borrar.php" method="POST">
        cedula: <input type="text" name="cedula" id="cedula">
        <br><input type="submit" value="borrar" name="borrar">

         </form>
    <?php if ($resultado==1) {
        echo("<a>borrado correctamente</a>");
    }else {
        echo("<a>No Borrado </a>");
    } ?>
</body>
</html>