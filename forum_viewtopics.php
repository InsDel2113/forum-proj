<?php
require_once 'internal/includes.php';
?>
<body>
<div class="container">
<a href="forum_newtopic.php?cat_id=<?php echo $_GET['cat_id']; ?>">new topic</a>  
<br>
<br>
<fieldset>    
<?php
 $forum_tops = $db->query('SELECT * FROM forum_topics WHERE cat_id = ? ORDER BY id DESC LIMIT 10 ', $_GET['cat_id'])->fetch_all();
  if ( count($forum_tops) == 0 ) {
	 $misc->error("Invalid ID");
	 die();
 }
 foreach ($forum_tops as $forum_tops_val) {
	 ?> 
          <a href="forum_viewpost.php?id=<?php echo $forum_tops_val['id'];?>">       
      <?php echo htmlspecialchars($forum_tops_val['title']); ?>
	  </a>
	  <br>
                				  
	 <?php
 }
?>
</fieldset>
</div>
</body>
</html>