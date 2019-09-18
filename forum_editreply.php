<?php
require_once 'internal/includes.php';
if ( $user->get_loggedin() === false ) {
$misc->error("you arent logged in");
die();
}
$edit_err_msg = "";
if ( $misc->has_posted_nonvar() ) {
	
	if ( $misc->has_posted($_POST['edit_content']) ) {
		$catch_edit_err = $forum->edit_reply_data($_POST['edit_content'], $_GET['id']);
		if ( $catch_edit_err != "reply_editsuccess" ) {
			$edit_err_msg = $catch_edit_err;
		}
	if ( $catch_edit_err == "reply_editsuccess" ) {
		$misc->redirect('forum_viewpost.php?id='.$_GET["orig_thread_id"].'');
	}
	}
}

?>
<body>
<div class="container">
<form action="forum_editreply.php?id=<?php echo $_GET['id'];?>&orig_thread_id=<?php echo $_GET['orig_thread_id'];?>" method="post">
      <div class="form-group">
        <input id="text" name="edit_content" type="text" value="<?php  $topic_values = $db->query('SELECT content FROM forum_replies WHERE id = ?', $_GET['id'])->fetch_array(); echo htmlspecialchars($topic_values['content']); ?>">
      </div>
      <div class="form-group">
        <button class="btn btn-default" type="submit" role="button" name="submit" id="submit">Edit reply</button>
      </div>
  </form>
  </div>
  <?php echo "<center>$edit_err_msg</center>" ?>
  </body>
  </html>