<?php
$host="localhost";
$user="root";
$psw="";
$bd="cuarto";
$conn=mysqli_connect($host,$user,$psw,$bd);
if (!$conn) {
    die(json_encode("Error".mysqli_connect_error()));
}

$sql="SELECT * FROM estudiantes";
$rs=$conn->query($sql);
$result=[];
if (isset($_POST['buscarUnico'])) {
    $cedula=$_POST['cedula'];
    $sql="SELECT * FROM estudiantes WHERE estCedula='$cedula'";
    $result=$conn->query($sql);
    
}   
if (isset($_POST['nuevo'])) {
    $cedula=$_POST['cedula'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $telefono=$_POST['telefono'];
    $direccion=$_POST['direccion'];
    $sql="INSERT INTO estudiantes (estCedula,estNombre,estApellido,estTelefono,estDireccion)
    VALUES('$cedula','$nombre','$apellido','$telefono','$direccion')";
    if (!$conn->query($sql)) {
        die(json_encode("Error de insert:".$conn->error()));
    }
    header("Location: index.php");
}
if (isset($_POST['actualizar'])) {
     $cedula=$_POST['cedula'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $telefono=$_POST['telefono'];
    $direccion=$_POST['direccion'];
    $sql="UPDATE estudiantes SET estNombre='$nombre',estApellido='$apellido',estTelefono=$telefono,
    estDireccion='$direccion' WHERE estCedula='$cedula'";
    
    if (!$conn->query($sql)) {
        die(json_encode("Error de insert:".$conn->error()));
    }
    header("Location: index.php");

}

if (isset($_POST['borrar'])) {
    $cedula=$_POST['cedula'];
    $sql="DELETE FROM estudiantes WHERE estCedula='$cedula'";
    
    if (!$conn->query($sql)) {
        die(json_encode("Error de insert:".$conn->error()));
    }
    header("Location: index.php");
    
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
    <section>
        <form action="reporte.php" method="POST" target="_blank">
    <button type="submit">Generar Reporte PDF</button>
</form>
<form action="reporteCedula.php" method="POST" target="_blank">
    Cedula : <input type="text" name="cedula" id="cedula">
    <button type="submit">Generar Reporte PDF</button>
</form>

    </section>
    <section>
        
        <table border=1>
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Direccion</th>
                
            </tr>
            <?php while($row=$rs->fetch_assoc()){?>
                <tr>
                    <td> <?php echo($row['estCedula']) ?></td>
                    <td> <?php echo($row['estNombre']) ?></td>
                    <td> <?php echo($row['estApellido']) ?></td>
                    <td> <?php echo($row['estTelefono']) ?></td>
                    <td> <?php echo($row['estDireccion']) ?></td>
                </tr>
            <?php } ?>
        </table>
    </section>
    <section>
        <?php if($result!=null) {?>
        <table border=1>
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Direccion</th>
                
            </tr>
            <?php while($row=$result->fetch_assoc()){?>
                <tr>
                    <td> <?php echo($row['estCedula']) ?></td>
                    <td> <?php echo($row['estNombre']) ?></td>
                    <td> <?php echo($row['estApellido']) ?></td>
                    <td> <?php echo($row['estTelefono']) ?></td>
                    <td> <?php echo($row['estDireccion']) ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php } ?>
        <form action="index.php" method="POST">
                Buscar por cedula: <input type="text" name="cedula" id="cedula">
                <input type="submit" value="buscar" name="buscarUnico">
        </form>
    </section>
    <section>
            <h1>Nuevo</h1>

        <form action="index.php" method="POST">
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
    </section>
    <section>
            <h1>actualizar</h1>

        <form action="index.php" method="POST">
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
                <input type="submit" value="actualizar" name="actualizar">
        </form>
    </section>
    <section>
        <form action="index.php" method="POST">
            cedula a borrar: <input type="text" name="cedula" id="cedula">
            <input type="submit" value="borrar" name="borrar">
        </form>
    </section>
</body>
</html>