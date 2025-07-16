<?php
$host="localhost";
$user="root";
$psw="";
$bd="cuarto";
$conn=mysqli_connect($host,$user,$psw,$bd);
if (!$conn) {
    echo(json_encode("Error".mysqli_connect_error()));
}

$sql="SELECT * FROM usuarios1";
$rs=$conn->query($sql);

if (isset($_POST['ingresar'])) {
    $user=$_POST['user'];
    $psw=$_POST['psw'];
    while ($row=$rs->fetch_assoc()) {
        if ($row['user']==$user && password_verify($psw,$row['psw'])) {
            die(header("Location: index.php"));
        }
    }
    echo(json_encode("Error al ingresar ".$conn->error_log()));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="POST">
    user: <input type="text" name="user" id="user">
    <br>
    contrasenia: <input type="text" name="psw" id="psw">
    <br>
    <input type="submit" value="ingresar" name="ingresar">
    </form>
</body>
</html>