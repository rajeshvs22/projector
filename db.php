<?php 


//LOCAL SERVER
/* Database connection start */
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "reload";

//SERVER DB
$servername = "localhost";
$username = "aryvaqku_reload";
$password = '8#=HKfze$K0x';
$dbname = "aryvaqku_projector";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>