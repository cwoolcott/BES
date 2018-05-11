<?php

$servername = "localhost";
$username = "inventiv_ks";
$password = "^*C<9d#C";
$db = "inventiv_keysurvey";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
$conn1 = new mysqli($servername, $username, $password, $db);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

