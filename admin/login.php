<?php
session_start();

$response = '';
$_SESSION['login']=false;

if ($_POST['u']=='admin' && $_POST['p']=='Talent123!'){
	$_SESSION['login']=true;
	$response = "Login";
}
    
echo json_encode($response);