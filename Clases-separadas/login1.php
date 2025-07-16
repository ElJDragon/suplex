<?php
$host="localhost";
$user="root";
$psw="";
$bd="cuarto";

$conn=mysqli_connect($host,$user,$psw,$bd);
if (!$conn) {
    die(json_encode("Error".mysqli_connect_error()));
}

$sql="SELECT * FROM usuarios1";
$rs=$conn->query($sql);
$falla=0;
if (isset($_POST['ingresar'])) {
    $user=$_POST['user'];
    $psw=$_POST['psw'];
    while ($row=$rs->fetch_assoc()) {
        if ($row['user']==$user && password_verify($psw,$row['psw'])) {
            die(header("Location: views/index.php"));
        }
    }
    $falla=1;
    
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login1</title>
</head>
<body>
    <form action="login1.php" method="POST">
        <input type="text" name="user" id="user">
        <br>
        <input type="text" name="psw" id="psw">
        <br>
        <input type="submit" value="ingresar" name="ingresar">
    
    </form>
    <?php  if ($falla==1) { ?>
        <h1>Usuario o contrsenia indorrectos</h1>
   <?php } ?>
</body>
</html>