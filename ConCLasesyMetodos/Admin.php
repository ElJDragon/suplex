<?php
include_once 'conexion.php';
session_start();

if (isset($_POST['salir'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
// Si no es admin, redirigir
if ($_SESSION["user"] !== "admin") {
    header("Location: login.php");
    exit();
}

// Consulta pregunta 1
$sql1 = "SELECT PREG1, COUNT(*) AS total FROM encuesta GROUP BY PREG1";
$r1 = $conn->query($sql1);

// Consulta pregunta 2
$sql2 = "SELECT PREG2, COUNT(*) AS total FROM encuesta GROUP BY PREG2";
$r2 = $conn->query($sql2);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Encuestas</title>
</head>
<body>
    <h2>Resultados Pregunta 1: ¿Sabes Programación Orientada a Objetos?</h2>
    <table border=1>
        <tr><th>Respuesta</th><th>Total</th></tr>
        <?php while($row=$r1->fetch_assoc()){ ?>
        <tr>
            <td><?php echo($row["PREG1"]); ?></td>
            <td><?php echo($row["total"]); ?></td>
        </tr>
        <?php } ?>
    </table>

    <h2>Resultados Pregunta 2: ¿Sabes PHP?</h2>
    <table border=1>
        <tr><th>Respuesta</th><th>Total</th></tr>
        <?php while($row=$r2->fetch_assoc()){ ?>
        <tr>
            <td><?php echo($row["PREG2"]); ?></td>
            <td><?php echo($row["total"]); ?></td>
        </tr>
        <?php } ?>
    </table>

    <form action="Admin.php" method="POST">
        <button type="submit" name="salir">Cerrar Sesión</button>
    </form>
</body>
</html>
