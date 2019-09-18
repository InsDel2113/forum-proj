<?php
// docs
/*
new_cat($name, $description) - creates new forum category, with $name as the name and $description as the description(self explanatory)
new_topic($title, $content, $creator, $cat_id) - creates a new topic in the specified $cat_id, with $title as the title and $content as the text/content within the post. $creator = the user id of whoever posted it
new_reply($content, $post_id, $thread_id) - creates a reply on specified $thread_id, with $post_id as the original poster.
edit functions self explanatory, $content as first var, $id of the post you want to edit.
*/


class forum { 
 public function new_cat($name, $description) {
        global $db;
		global $logger;
        if (strlen($name) === 0) {
            return 'name_empty';
        } elseif (strlen($description) === 0) {
            return 'description_empty';
        } elseif (strlen($name) > 16) {
            return 'name_toolong';
        } elseif (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $description)) {
            return 'name_notalphanumeric';
        }
        $newcat_query = $db->query('INSERT INTO forum_categories (name, description) VALUES (?,?)', $name, $description);
		return 'newcat_success';
    }
	 public function new_topic($title, $content, $creator, $cat_id) {
        global $db;
		global $logger;
        if (strlen($title) === 0) {
            return 'title_empty';
        } elseif (strlen($content) === 0) {
            return 'content_empty';
        } elseif (strlen($title) > 16) {
            return 'title_toolong';
        } elseif ( strlen($content) > 5000 ) {
			return 'content_toolong';
		}
		$logger->add_log("new topic created");
        $newcat_query = $db->query('INSERT INTO forum_topics (title, content, creator_id, cat_id) VALUES (?,?,?,?)', $title, $content, $creator, $cat_id);
		return 'newtopic_success';
    }
	public function new_reply($content, $post_id, $thread_id) {
        global $db;
		global $logger;
        if (strlen($content) === 0) {
            return 'content_empty';
        } elseif (strlen($content) > 5000) {
            return 'content_toolong';
        }
		$logger->add_log("user created new reply");
        $newrep_query = $db->query('INSERT INTO forum_replies (content, creator_id, orig_thread) VALUES (?,?,?)', $content, $post_id, $thread_id);
		return 'newreplie_success';
    }
   public function edit_topic_data($content, $id) {
	   global $user;
	   global $db;
	   global $logger;
	   $forum_ownercheck = $db->query('SELECT creator_id FROM forum_topics WHERE creator_id = ? AND id = ?', $user->get_userid(), $id)->fetch_array();
	   if ( count($forum_ownercheck) == 0 ) {
		   return 'user_doesnotown';
	   }
        if (strlen($content) === 0) {
            return 'content_empty';
        } elseif ( strlen($content) > 5000 ) {
			return 'content_toolong';
		}
		$logger->add_log("user edited topic");
	   $newrep_query = $db->query('UPDATE forum_topics SET content=? WHERE id=?', $content, $id);
	   return 'topic_editsuccess';
   }
      public function edit_reply_data($content, $id) {
	   global $user;
	   global $db;
	   global $logger;
	   $forum_ownercheck = $db->query('SELECT creator_id FROM forum_replies WHERE creator_id = ? AND id = ?', $user->get_userid(), $id)->fetch_array();
	   if ( count($forum_ownercheck) == 0 ) {
		   return 'user_doesnotown';
	   }
        if (strlen($content) === 0) {
            return 'content_empty';
        } elseif ( strlen($content) > 5000 ) {
			return 'content_toolong';
		}
		$logger->add_log("user edited reply");
	   $newrep_query = $db->query('UPDATE forum_replies SET content=? WHERE id=?', $content, $id);
	   return 'reply_editsuccess';
   }
}