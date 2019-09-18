<?php
// class to log actions and other stuff
// is its own object/class because i want it to be expandable
class logger {
	public function add_log($content) {
		global $db;
		global $user;
		$time = time();
		$cur_user = $user->get_userid();
		$cur_user_name = $user->id_to_username($cur_user);
		$log_str = "[$time - $cur_user_name($cur_user)] $content";
		$addlog_query = $db->query('INSERT INTO logs (content) VALUES (?)', $log_str);
	}
}