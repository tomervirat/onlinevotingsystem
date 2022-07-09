<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "onlinevotingsystem";

$con = mysqli_connect($server, $username, $password, $db);
if(!$con){
    die("connection to this database failed due to" .mysqli_connect_error());
}
?>