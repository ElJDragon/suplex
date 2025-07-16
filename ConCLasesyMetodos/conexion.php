<?php
$host="localhost";
$user="root";
$psw="";
$BD="cuarto";
$conn=mysqli_connect($host,$user,$psw,$BD);
if (!$conn) {
    die(json_encode(mysqli_connect_error()));    
}
return $conn;

?>