<?php
require_once 'internal/includes.php';

?>
<body>
<div class="container">
<fieldset>
              
<?php
 $forum_cats = $db->query('SELECT * FROM forum_categories')->fetch_all();
 foreach ($forum_cats as $forum_cat_val) {
	 ?> 
                
				  <li>
				  <a href="forum_viewtopics.php?cat_id=<?php echo $forum_cat_val['id']; ?>">
      <?php echo htmlspecialchars($forum_cat_val['name']); ?>
	  </a>
      <ul>
        <li><?php echo htmlspecialchars($forum_cat_val['description']); ?></li>
      </ul>
    </li>
                				  
	 <?php
	 
	
 }
?>
</fieldset>
			</div>
</body>
</html>