<?php


$servername = "localhost";
$username = "meduser";
$password = "m3dread";
$dbname = "medread";

$ip = "0.0.0.0";

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];

} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

} else {
$ip = $_SERVER['REMOTE_ADDR'];

}

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
 }

 $sql = "INSERT INTO subscribers (host, name , email,message,ip) values ( \"". $_SERVER['HTTP_HOST']."\" ,\"" .$_GET['name'] . "\",\"" . $_GET['email'] ."\" , \"". $_GET['msg']. "\" , \"" .  $ip . "\")";


 if ($conn->query($sql) === TRUE) {
         echo "Got it, will be in touch.";


 $message = wordwrap( 'From: ' .  $_GET['name'] . $_GET['msg'], 70, "\r\n");

 // Send
 mail('aarbache@gmail.com','Get in Touch', $message);

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
