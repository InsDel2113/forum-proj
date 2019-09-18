<?php
ob_start();
include "../includes.php";
ob_end_clean();

if ( !isset($_GET['id']) ){
die("id_invalid");
}

$id = $_GET['id'];
$user_info = $db->query('SELECT userid, username, power, banned FROM users WHERE username = ?', $id)->fetch_array();
if ( count($user_info) == 0 ) {
die("id_invalid");
}

echo htmlspecialchars(json_encode($user_info));