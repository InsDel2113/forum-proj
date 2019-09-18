<?php

include "internal/includes.php";

if ( $user->get_loggedin() === false ) {
$misc->error("you arent logged in");
die();
}
// visual aids below
if ( $misc->has_posted_nonvar() ) {
	if ( !$misc->has_posted($_POST['new_password']) ) {
	if ( $misc->has_posted($_POST['blurb']) ) { // check for blurb post
	$validation_failed = false;
	if ( strlen($_POST['blurb']) === 0 ) { $misc->error("blurb cannot be empty"); $validation_failed = true; }
	if ( strlen($_POST['blurb']) > 512 ) { $misc->error("blurb cannot be over 512 characters"); $validation_failed = true;}
	if ( !$validation_failed ) {
	$db->query("UPDATE users SET blurb = ? WHERE userid = ?", $_POST['blurb'], $user->get_userid());
	$misc->success("successfully updated blurb");
	}
	}
	}
	if ( !$misc->has_posted($_POST['blurb'])) {
	if ( $misc->has_posted($_POST['old_password']) & $misc->has_posted($_POST['new_password']) & $misc->has_posted($_POST['new_password_confirm']) ) { // check for post of all password-related stuff
	    $logger->add_log("user attempted to change password");
		if ( strlen($_POST['old_password']) === 0 ) { $misc->error("old password cannot be empty"); $validation_failed = true;}
		if ( strlen($_POST['new_password']) === 0 ) { $misc->error("new password cannot be empty"); $validation_failed = true;}
		if ( strlen($_POST['new_password_confirm']) === 0 ) { $misc->error("new password confirmation cannot be empty"); $validation_failed = true;}
		if ( $_POST['new_password'] != $_POST['new_password_confirm'] ) { $misc->error("new password and new password confirmation do not match"); }
		
		$password_info = $db->query('SELECT password FROM users WHERE userid = ?', $user->get_userid())->fetch_array();
        if (!password_verify($_POST['old_password'], $password_info['password'])) {
            $misc->error("old password and current password do not match");
			$validation_failed = true;
        }
		if ( !$validation_failed ) {
			$logger->add_log("user successfully changed password");
			$db->query("UPDATE users SET password = ? WHERE userid = ?", password_hash($_POST['new_password'], PASSWORD_DEFAULT), $user->get_userid());
			$misc->success("successfully updated password");
		}
	}
	}
}

?>
<body>
<div class="container">
<table>
              <caption>
                
              </caption>
              <thead>
                <tr>
                  <th>setting</th>
                  <th>value</th>
                  <th>confirmation</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th colspan="4">settings</th>
                </tr>
              </tfoot>
              <tbody>
                <tr>
				<form action="settings.php" method="post">
                  <th>blurb</th>
                  <td><input type="text" name="blurb" placeholder="blurb here"></td>
                  <td><center><button class="btn btn-default" type="submit" role="button" name="submit" id="submit">submit</button></center></td>
				  <form>
                </tr>
				 <tr>
				<form action="settings.php" method="post">
                  <th>password</th>
                  <td><input type="password" name="old_password" placeholder="old password"><input type="password" name="new_password"  placeholder="new password"><input type="password" name="new_password_confirm"  placeholder="new password confirm"></td>
                  <td><center><button class="btn btn-default" type="submit" role="button" name="submit" id="submit">submit</button></center></td>
				  <form>
                </tr>
              </tbody>
            </table>
			</div>
</body>
</html>
