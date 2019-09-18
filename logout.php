<?php
include 'internal/includes.php';
session_unset();
session_destroy();
$misc->redirect("index.php"); 
?>
