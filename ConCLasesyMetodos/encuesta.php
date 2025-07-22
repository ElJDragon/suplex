<?php
include_once 'conexion.php';
session_start();
$user=$_SESSION['user'];
$sql="SELECT INTENTOS FROM usuariose WHERE ID_USU='$user'";
$rs=$conn->query($sql);
$row = $rs->fetch_assoc();
$intento = $row["INTENTOS"] ?? 0;

$encuesta="SELECT * FROM encuesta WHERE ID_USU='$user'";
$rsE=$conn->query($encuesta);


if (isset($_POST['subir'])) {
    $preg1=$_POST['preg1'] ?? '';
    $preg2=$_POST['preg2'] ?? '';
    $insert="INSERT INTO encuesta (ID_USU,PREG1,PREG2)
    VALUES ('$user','$preg1','$preg2')";
    
    $conn->query($insert);
    $update="UPDATE usuariose  SET INTENTOS=1 WHERE ID_USU='$user'";
    $conn->query($update);
    header("Location: encuesta.php");

}
if (isset($_POST['salir'])) {
    session_abort();
    header("Location: login.php");
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>enceusta</title>
</head>
<body>
    <?php $row=[];if($intento==1){ ?>
        <section>
           <table border=1>
            <tr>
                <th>PREGUNTA1</th>
                <th>Pregunta2</th>
            </tr>
            <?php while($row=$rsE->fetch_assoc()) {?>
                <tr>
                    <td> <?php echo($row['PREG1']) ?></td>
                    <td> <?php echo($row['PREG2']) ?></td>
                </tr>
            <?php } ?>
           </table>
         
        </section>
    <?php }else{ ?>
    <section>
        <form action="encuesta.php" method="POST">
            sabe POO?:
            <input type="radio" name="preg1"  value="SI" required>SI
            <input type="radio" name="preg1"  value="NO" required>NO
            <br>
            <br>
            sabe PHP?:
            <input type="radio" name="preg2"  value="SI" required>SI
            <input type="radio" name="preg2"  value="NO" required>NO
            <br>
            <br>
            <input type="submit" value="subir" name="subir">
        </form>
    </section>
    <?php } ?>
    <form action="encuesta.php" method="POST">
        
            <input type="submit" value="salir" name="salir">
    </form>
</body>
</html>