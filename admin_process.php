<?php

require_once 'internal/includes.php';
echo '<div class="container">';
echo '<fieldset>';
echo '<legend>admin process request</legend>';
if ( $user->get_power() > 0 ) {
	$get_var = $_GET['type'];
	$id = $_GET['id']; // clean this up later
	if ( $get_var == "delete_topic" ) {
		$db->query("DELETE FROM forum_topics WHERE id = ?", $_GET['id']);
		$logger->add_log("admin deleted topic($id)");
		$misc->success("successfully deleted topic");
	}
	if ( $get_var == "delete_reply" ) {
		$db->query("DELETE FROM forum_replies WHERE id = ?", $_GET['id']);
		$logger->add_log("admin deleted reply($id)");
		$misc->success("successfully deleted reply");
	}
	if ( $get_var == "ban_user" ) {
		$db->query('UPDATE users SET banned=? WHERE userid=?', 1, $_GET['id']);
		$logger->add_log("admin banned user($id)");
		$misc->success("successfully banned user");
	}
}
echo '</fieldset>';
echo '</div>';

// bangla way of doing success
// and bangla way of doing admin shit in general

// works though

?>
