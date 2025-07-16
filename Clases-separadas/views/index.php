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
$resultado=[];
if (isset($_POST['buscar'])) {
    $cedula=$_POST['cedula'];
    $sql="SELECT * FROM estudiantes WHERE estCedula='$cedula'";
    $resultado=$conn->query($sql);
    
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
        <h2>Menu principal</h2>
        <li>
            <a href="guardar.php">nuevo</a>
            <a href="editar.php">editar</a>
            <a href="borrar.php">borrar</a>
            <a href="reporte.php">reporte general</a>

        </li>

    </section>
    <section>
        <table border=1>
            <?php while($row=$rs->fetch_assoc()) {?>
                <tr>
                    <td><?php echo($row['estCedula']) ?></td>
                    <td><?php echo($row['estNombre']) ?></td>
                    <td><?php echo($row['estApellido']) ?></td>
                    <td><?php echo($row['estTelefono']) ?></td>
                    <td><?php echo($row['estDireccion']) ?></td>
                </tr>
            <?php } ?>
        </table>
    </section>
    <section>
        <h1>Buscar</h1>
        <form action="index.php" method="POST">
            <input type="text" name="cedula" id="cedula">
            <input type="submit" value="buscar" name="buscar">
        </form>
        <?php if ($resultado!=null){ ?>
        <table border=1>
            <?php while($row=$resultado->fetch_assoc()) {?>
                <tr>
                    <td><?php echo($row['estCedula']) ?></td>
                    <td><?php echo($row['estNombre']) ?></td>
                    <td><?php echo($row['estApellido']) ?></td>
                    <td><?php echo($row['estTelefono']) ?></td>
                    <td><?php echo($row['estDireccion']) ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php } ?>
    </section>
    <SECtion>
        <form action="reportecedula.php" method="POST">
            <input type="text" name="cedula" id="cedula">
            <input type="submit" value="reporte" name="buscar" >
            <a href="reportecedula.php"></a>
        </form>
    </SECtion>
</body>
</html>