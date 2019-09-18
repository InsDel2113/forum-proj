<?php
// how to use this class:
/*
this is the user class, it holds all user vars for ease of use.

before doing anything, make sure you've called init_user().
( this is already done in includes.php, so you dont need to if you include includes.php )

all of the get_x() functions return unsanitized output, so sanitize if you're gonna display or use it anywhere.

id_to_username($id), returns username of specified id.
username_to_id($id), returns id of specified username.



*/
class user {
    private $userid;
    private $username;
    private $password;
    private $power;
    private $ip;
    private $banned;
    public function init_user() {
        global $db;
        $this->userid = 0;
        $this->username = "Guest";
        $this->password = null;
        $this->power = 0;
        $this->ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SESSION['logged_in'])) {
            $this->userid = $_SESSION['userid'];
            $this->username = $_SESSION['username'];
            $this->password = $_SESSION['password'];
            $this->power = $_SESSION['power'];
            $this->ip = $_SESSION['ip'];
            $fetch_banned = $db->query('SELECT banned FROM users WHERE username = ?', $_SESSION['username'])->fetch_array(); // weird and sketchy but works, may slow stuff down a little bit though cuz mysql
            $this->banned = $fetch_banned['banned'];
        }
    }
    public function get_userid() {
        return $this->userid;
    }
    public function get_password() {
        return $this->password;
    }
    public function get_power() {
        return $this->power;
    }
    public function get_ip() {
        return $this->ip;
    }
    public function get_banned() {
        return $this->banned;
    }
    public function get_username() {
        return $this->username;
    }
    public function get_loggedin() {
        if (isset($_SESSION['logged_in'])) {
            return $_SESSION['logged_in'];
        } else {
            return false;
        }
    }
    public function id_to_username($id) { 
        // takes id as input, outputs username
		global $db;
        $query = $db->query('SELECT username FROM users WHERE userid = ?', $id)->fetch_array();
        if (count($query) === 0) {
            return 'error';
        }
        return $query['username'];
    }
	    public function username_to_id($uname) { 
        // takes username as input, outputs id aka vice versa of the function above
		global $db;
        $query = $db->query('SELECT userid FROM users WHERE username = ?', $uname)->fetch_array();
        if (count($query) === 0) {
            return 'error';
        }
        return $query['userid'];
    }
}
?>