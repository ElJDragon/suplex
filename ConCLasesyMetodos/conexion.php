<?php
$host="localhost";
$user="root";
$psw="";
$BD="cuarto";
$conn=mysqli_connect($host,$user,$psw,$BD);
if (!$conn) {
    die("Error".mysqli_connect_error());

}
return($conn);
?>