<?php
require_once 'internal/includes.php';
if (!isset($_GET['id']) ) {
	$misc->error("invalid id");
	die();
}
$user_info = $db->query('SELECT * FROM users WHERE userid = ?', $_GET['id'])->fetch_array();
if ( count($user_info) === 0 ) {
	$misc->error("user not found");
	die();
}
$forum_posts = $db->query('SELECT * FROM forum_topics WHERE creator_id = ?', $user_info['userid'])->fetch_array();
$forum_replies = $db->query('SELECT * FROM forum_replies WHERE creator_id = ?', $user_info['userid'])->fetch_array();

if ( $user->get_power() > 0 ) {
	echo '<center><a href="admin_process.php?type=ban_user&id='.$_GET['id'].'">ban</a></center>';
}

?>
<body>
<div class="container">
<center>
<fieldset>
<legend><?php echo $user_info['username'];?></legend><i><q>
<?php echo htmlspecialchars($user_info['blurb']); ?>
</q></i>
<br>
Forum posts:
<?php echo count($forum_posts) + count($forum_replies); ?>
</fieldset>
</center>
</div>
</body>
</html>