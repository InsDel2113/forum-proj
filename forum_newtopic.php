<?php 

require_once 'internal/includes.php';

if ( $user->get_loggedin() === false ) {
$misc->error("you arent logged in");
die();
}
if ( $misc->has_posted_nonvar() ) {
	if ( $misc->has_posted($_POST['title']) & $misc->has_posted($_POST['content']) ) {
	$new_top_catch = $forum->new_topic($_POST['title'], $_POST['content'], $user->get_userid(), $_GET['cat_id']);
	if ( $new_top_catch != "newtopic_success" ) {
	echo "<center>$new_top_catch</center>";
	}
	if ( $new_top_catch == "newtopic_success") {
		 $current_highest_id = $db->query('SELECT * FROM forum_topics ORDER BY id DESC LIMIT 0, 1')->fetch_array();
         $final_id = $current_highest_id['id'];
		 $misc->redirect("forum_viewpost.php?id=$final_id");
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
                  <th>title</th>
				  <th></th>
                  <th>content</th>
				  <th></th>
				  <th>confirmation</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th colspan="5">forum post topic</th>
                </tr>
              </tfoot>
              <tbody>
                <tr>
				<form action="forum_newtopic.php?cat_id=<?php echo $_GET['cat_id']; ?>" method="post">
                  <th>title</th>
                  <td><input type="text" name="title"></td>
				  <th>content</th>
                  <td><input type="text" name="content"></td>
                  <td><center><button class="btn btn-default" type="submit" role="button" name="submit" id="submit">submit</button></center></td>
				  <form>
                </tr>
              </tbody>
            </table>
			</div>
</body>
</html>
