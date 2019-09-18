<?php 
require_once 'internal/includes.php';
$reply_err_msg = "";
if ( $misc->has_posted_nonvar() ) {
	if ( $misc->has_posted($_POST['reply']) ) {
		$catch_reply_err = $forum->new_reply($_POST['reply'], $user->get_userid(), $_GET['id']);
		if ( $catch_reply_err != "newreplie_success" ) {
			$reply_err_msg = $catch_reply_err;
		}
	}
}

?>
<body>
<?php
 $topic_values = $db->query('SELECT * FROM forum_topics WHERE id = ?', $_GET['id'])->fetch_array();
 if ( count($topic_values) == 0 ) {
	 $misc->error("Invalid ID");
	 die();
 }
 $owner_username = htmlspecialchars($user->id_to_username($topic_values['creator_id'])); // to save on one mysql querie
 $owner_uid = $topic_values['creator_id'];
 ?>
 <body>
 <div class="container">
 <div class="terminal-timeline">
    <div class="terminal-card">
      <header><?php echo htmlspecialchars($topic_values['title']); ?> -  <a href="profile.php?id=<?php echo $owner_uid ?>"><?php echo $owner_username; ?></a><?php if ( $topic_values['creator_id'] == $user->get_userid() ) { ?><a href="forum_edittopic.php?id=<?php echo $_GET['id'];?>" style="float:right;">edit</a><?php } ?> <?php if ( $user->get_power() > 0 ) { echo '<a href="admin_process.php?type=delete_topic&id='.$_GET['id'].'" style="float:right;"> delete&nbsp; </a>'; }?></header>
      <div>
   <?php  echo htmlspecialchars($topic_values['content']); ?>
      </div>
    </div>
	<br>
 <?php
 $forum_replies = $db->query('SELECT * FROM forum_replies WHERE orig_thread = ?', $_GET['id'])->fetch_all();
 foreach ($forum_replies as $forum_repl_val) {
	 $cur_reply_username = htmlspecialchars($user->id_to_username($forum_repl_val['creator_id'])); // again, to save on a mysql querie
	 $cur_reply_uid = $forum_repl_val['creator_id'];
	 ?> 
                
	      <div class="terminal-card">
      <header><?php echo "<a href='profile.php?id=$cur_reply_uid'>$cur_reply_username</a>"; ?><?php if ( $forum_repl_val['creator_id'] == $user->get_userid() ) { ?><a href="forum_editreply.php?id=<?php echo $forum_repl_val['id'];?>&orig_thread_id=<?php echo $_GET['id']?>" style="float:right;">edit</a><?php } ?><?php if ( $user->get_power() > 0 ) { echo '<a href="admin_process.php?type=delete_reply&id='.$forum_repl_val['id'].'" style="float:right;"> delete&nbsp; </a>'; }?></header></header>
      <div>
              <?php echo htmlspecialchars($forum_repl_val['content']); ?>
      </div>
    </div>
	<br>
                				  
	 <?php
 }
 echo "<center>$reply_err_msg</center>";
?>
<br>
<br>
<form action="forum_viewpost.php?id=<?php echo $_GET['id'];?>" method="post">
      <div class="form-group">
        <input id="text" name="reply" type="text">
      </div>
      <div class="form-group">
        <button class="btn btn-default" type="submit" role="button" name="submit" id="submit">Reply</button>
      </div>
  </form>
  </div>
  </div>
</body>
</html>