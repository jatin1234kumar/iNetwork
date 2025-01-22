<?php 

$servername = "localhost";
$username = "root";
$password = "";
$database = "inetwork";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Sorry we failed to connect to the website". mysqli_connect_error());
}else {
    echo "";
}


?>