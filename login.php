<?php
require_once 'internal/includes.php';
if ( $misc->has_posted_nonvar() ) {
 if ( $misc->has_posted($_POST['username']) & $misc->has_posted($_POST['password']) ) {
	 $login_catch = $entry->login($_POST['username'], $_POST['password']);
	 // i dont know what to name $login_catch, so that'll do.
 }
}
?>
<body>
<div class="container">
<?php if ( !empty($login_catch) ) {
	   if ( $login_catch != 'login_success' ) {
	?>
<div class="terminal-alert terminal-alert-error"><?php echo $login_catch;?></div>
<?php } else{ echo '<div class="terminal-alert terminal-alert-primary">login successfull</div>'; $misc->redirect_wait("index.php", 1); die();} }?>

<form action="login.php" method="post">
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="password"><br>
  <br>
  <button class="btn btn-default" type="submit" role="button" name="submit" id="submit">Login</button>
</form>
</div>
</body>
</html>