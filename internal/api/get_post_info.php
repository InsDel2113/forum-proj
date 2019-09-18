<?php
ob_start();
include "../includes.php";
ob_end_clean();

if ( !isset($_GET['id']) ){
die("id_invalid");
}

 $topic_values = $db->query('SELECT * FROM forum_topics WHERE id = ?', $_GET['id'])->fetch_array();
 if ( count($topic_values) == 0 ) {
	 $misc->error("Invalid ID");
	 die();
 }


echo htmlspecialchars(json_encode($topic_values));