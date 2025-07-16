<?php
include_once 'conexion.php';
session_start();
$user = $_SESSION['user'];

// Verificar si ya votó
$sql = "SELECT * FROM usuariose WHERE ID_USU='$user'";
$rs = $conn->query($sql);
$intento = 0;
while ($row = $rs->fetch_assoc()) {
    if ($row['INTENTO'] == 1) {
        $intento = 1;
    }
}

// Obtener respuestas si ya votó
$sql1 = "SELECT * FROM encuesta WHERE ID_USU='$user'";
$rs1 = $conn->query($sql1);

$error = null;

if (isset($_POST['subir'])) {
    $PREG1 = $_POST['PREG1'] ?? '';
    $PREG2 = $_POST['PREG2'] ?? '';

    if (
        ($PREG1 != 'SI' && $PREG1 != 'NO') ||
        ($PREG2 != 'SI' && $PREG2 != 'NO')
    ) {
        $error = true;
    } else {
        // Guardar encuesta
        $insert = "INSERT INTO encuesta (PREG1, PREG2, ID_USU)
                   VALUES ('$PREG1', '$PREG2', '$user')";
        $conn->query($insert);

        // Marcar que ya votó
        $conn->query("UPDATE usuariose SET INTENTO=1 WHERE ID_USU='$user'");

        // Redirigir para recargar
        header("Location: index.php");
        exit();
    }
}
if (isset($_POST['cancelar'])) {
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
    <title>encuesta</title>
</head>
<body>
    <?php echo("<h2> bienvenido ".$_SESSION['nombre']." ".$_SESSION['apellido']  ."</h2>") ?>
    <?php if ($intento==1) { ?>
    <table border=1>
        <tr>
            <th>Pregunta</th>
            <th>Respuesta</th>
        </tr>
        <?php while($row=$rs1->fetch_assoc()){ ?>
        <tr>
            <td>Sabes POO</td>
            <td><?php echo($row['PREG1']); ?></td>
        </tr>
        <tr>
            <td>Sabes PHP</td>
            <td><?php echo($row['PREG2']); ?></td>
        </tr>
        <?php } ?>
    </table>
    <form action="index.php" method="POST">
        <input type="submit" value="cancelar" name="cancelar">
    </form>
<?php } ?>

    <section>
            <?php if ($intento==0) { ?>
                <form action="index.php" method="POST">
                    <h3>Sabes Programación Orientada a Objetos:</h3>
                    <input type="radio" name="PREG1" value="SI" required> SI
                    <input type="radio" name="PREG1" value="NO" required> NO
                    <br><br>
                    <h3>Sabes PHP:</h3>
                    <input type="radio" name="PREG2" value="SI" required> SI
                    <input type="radio" name="PREG2" value="NO" required> NO
                    <br><br>
                    <button type="submit" name="subir">Enviar</button>
                    <button type="submit" name="cancelar">Cancelar</button>
                </form>
                
                

                <?php } ?>
    </section>
</body>
</html>