<?php
// how to use this class:
/*
this is the entry class, it has login and register.

important: register does not stop duplicate usernames from registering, you should always use id's in your sql queries.

register($username, $password), takes username and password as input. if everything goes well, it'll insert username and hashed password in db.

login($username, $password), takes username and password as input. if correct will set session vars for user.php to use.

error codes for register

username_empty (means that username is empty)
password_empty (means that password is empty, for security reasons.)
username_toolong (means that username is too long)
username_notalphanumeric (means that username isnt alphanumeric, we dont want spaces or anything crazy in the users username)
register_success (means register was successful)

error codes for login

account_doesnotexist (means the account supplied/input from the $username does not exist)
account_passwordincorrect (means the supplied/input $password was incorrect for the specified $username)
login_success (means login was successful)

$uuid is a randomly generated id.

if you're going to do sql statements, use userid and NOT internal_id.


*/
class entry {
    public function register($username, $password) {
        global $db;
        if (strlen($username) === 0) {
            return 'username_empty';
        } elseif (strlen($password) === 0) {
            return 'password_empty';
        } elseif (strlen($username) > 16) {
            return 'username_toolong';
        } elseif (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $username)) {
            return 'username_notalphanumeric';
        }
        $uuid = (int)substr(preg_replace('/[^0-9]/', '', md5(uniqid())), 5, 16);
        $register_query = $db->query('INSERT INTO users (userid,username,password,ip) VALUES (?,?,?,?)', $uuid, $username, password_hash($password, PASSWORD_DEFAULT), $_SERVER['REMOTE_ADDR']);
		return 'register_success';
    }
    public function login($username, $password) {
        global $db;
		global $logger;
        $account_exists = $db->query('SELECT username, password FROM users WHERE username = ?', $username);
        if ($account_exists->num_rows() == 0) {
            return 'account_doesnotexist';
        }
        $user_info = $db->query('SELECT * FROM users WHERE username = ?', $username)->fetch_array();
        if (!password_verify($password, $user_info['password'])) {
			$u_ip = $_SERVER['REMOTE_ADDR'];
			$logger->add_log("user failed to login to $username, incorrect password, user ip $u_ip");
            return 'account_passwordincorrect';
        }
        $_SESSION['userid'] = $user_info['userid'];
        $_SESSION['username'] = $user_info['username'];
        $_SESSION['password'] = $user_info['password'];
        $_SESSION['power'] = $user_info['power'];
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['logged_in'] = true;
		return 'login_success';
    }
}
