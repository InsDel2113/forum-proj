<?php
session_start();
require_once 'classes/db.php';
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';
$db = new db($dbhost, $dbuser, $dbpass, $dbname);
// database connection
require_once 'classes/entry.php';
$entry = new entry();
// entry aka auth initilization
require_once 'classes/user.php';
$user = new user();
$user->init_user();
// user initilization
require_once 'classes/misc.php';
$misc = new misc();
// misc functions/stuff initilization
require_once 'classes/forum.php';
$forum = new forum();
// logger intiliaztion
require_once 'classes/logger.php';
$logger = new logger();


$misc->navbar($user);

if ($user->get_loggedin() & $user->get_banned()) {
	$misc->error("you're banned");
    die();
}
if ($user->get_power() >= 1) {
    //echo "you're admin";
}
// trying to keep up with documentation of all the classes is hard to do with something like this
?>
