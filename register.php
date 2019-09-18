<?php
require_once 'internal/includes.php';
if ( $misc->has_posted_nonvar() ) {
 if ( $misc->has_posted($_POST['username']) & $misc->has_posted($_POST['password']) ) {
	 $reg_catch = $entry->register($_POST['username'], $_POST['password']);
	 // i dont know what to name $reg_catch, so that'll do.
 }
}
?>
<body>
<div class="container">
<?php if ( !empty($reg_catch) ) {
	   if ( $reg_catch != 'register_success' ) {
	?>
<div class="terminal-alert terminal-alert-error"><?php echo $reg_catch;?></div>
<?php } else{ echo '<div class="terminal-alert terminal-alert-primary">register successfull</div>'; } }?>
<form action="register.php" method="post">
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="password"><br>
  <br>
  <button class="btn btn-default" type="submit" role="button" name="submit" id="submit">Register</button>
</form>
</div>
</body>
</html>