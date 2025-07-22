<?php
include_once 'conexion.php';
session_start();
$preg1="SELECT PREG1,COUNT(*) as total FROM encuesta GROUP BY PREG1";
$preg2="SELECT PREG2,COUNT(*) as total FROM encuesta GROUP BY PREG2";
$rs1=$conn->query($preg1);
$rs2=$conn->query($preg2);

if (isset($_POST['logout'])) {

    session_abort();
    header("Location: login.php");

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
    <form action="admin.php" method="POST">
        <input type="submit" value="logout" name="logout">
    </form>
    <section>

          <table border=1>
        <tr>
            <th>Respuesta</th>
            <th>Total</th>
        </tr>
        <?php while($row = $rs1->fetch_assoc()) { ?>
        <tr>
            <td><?php echo ($row["PREG1"]); ?></td>
            <td><?php echo $row["total"]; ?></td>
        </tr>
        <?php } ?>
    </table>

    
    </section>
    <section>
    <h2>Resultados Pregunta 1: ¿Sabes POO?</h2>

        <table border=1>
<tr>
            <th>Respuesta</th>
            <th>Total</th>
        </tr>
        <?php while($row = $rs2->fetch_assoc()) { ?>
        <tr>
            <td><?php echo ($row["PREG2"]); ?></td>
            <td><?php echo $row["total"]; ?></td>
        </tr>
        <?php } ?>
    </table>

    </table>
    </section>
</body>
</html>