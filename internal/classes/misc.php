<?php
// misc functions
// other misc stuff
// whateva

// documentation
// has_posted($postvar) - $postvar = a post that you want to make sure has been posted/exists
class misc {
	public function has_posted($postvar) {
		if ( !$_SERVER['REQUEST_METHOD'] == 'POST' ) { // also alternative, comment out if this causes problems
			return false;
		}
		if ( !isset($postvar) ) {
			return false;
		}
		if (empty($_POST)) {
			return false;
		}
		 if ( empty($postvar) )
		 return false;
	    // you can add this back in if you want, but may cause problems if a var is supposed to be empty
		return true;
	}
		public function has_posted_nonvar() {
		if ( !$_SERVER['REQUEST_METHOD'] == 'POST' ) { // also alternative, comment out if this causes problems
			return false;
		}
		if (empty($_POST)) {
			return false;
		}

		return true;
	}
	public function error($err_str) {
		// not needed so much, but for ease of use
		echo '<div class="container"><div class="terminal-alert terminal-alert-error">'.$err_str.'</div></div>';
	}
	public function success($succ_str) {
		// same as above ^^
	echo '<div class="container"><div class="terminal-alert terminal-alert-primary">'.$succ_str.'</div></div>';
	}
	public function redirect($url) {
		echo '
		<script>
window.location.replace("'.$url.'");
</script>
';
	}
	public function redirect_wait($url, $time) {
		$miliseconds_time = $time * 1000;
			echo '
		<script>
		setTimeout(function(){
window.location.replace("'.$url.'");
}, '.$miliseconds_time.');
</script>
';
// meh, could be better
	}
	public function navbar($user_glob) { // $user_glob is retarded to use here but for the sake of templating im doing this
		if ( $user_glob->get_loggedin() ) {
			echo '
			<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="Description" content="Put your description here.">
			<title>test</title>
			 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css" integrity="sha256-uHu2MAd1LvCOVEAhvMld4LpJi7dUGS7GVzvG/5B3hlo=" crossorigin="anonymous" />
			<link rel="stylesheet" href="terminal.min.css" />
			<link rel="stylesheet" href="dark.css" />
			</head>
			<div class="terminal-nav">
            <div class="terminal-logo">
            <div class="logo terminal-prompt"><a href="profile.php?id='.$user_glob->get_userid().'" class="no-style">'.$user_glob->get_username().'</a></div>
            </div>
            <nav class="terminal-menu">
            <ul>
            <li><a class="menu-item" href="forum_viewcats.php">Forums</a></li>
            <li><a class="menu-item" href="logout.php">Log out</a></li>
            <li><a class="menu-item" href="settings.php">Settings</a></li>
            </ul>
            </nav>
            </div>
			';
		} else {
			echo '
			<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="Description" content="Put your description here.">
			<title>test</title>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css" integrity="sha256-uHu2MAd1LvCOVEAhvMld4LpJi7dUGS7GVzvG/5B3hlo=" crossorigin="anonymous" />
			<link rel="stylesheet" href="terminal.min.css" />
			<link rel="stylesheet" href="dark.css" />
			</head>
			<div class="terminal-nav">
            <div class="terminal-logo">
            <div class="logo terminal-prompt"><a href="#" class="no-style">Logo</a></div>
            </div>
            <nav class="terminal-menu">
            <ul>
            <li><a class="menu-item" href="login.php">Login</a></li>
            <li><a class="menu-item" href="register.php">Register</a></li>
            </ul>
            </nav>
            </div>
			';
		}
	}
}


?>