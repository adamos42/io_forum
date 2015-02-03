<?php

//require_once APPPATH.'libraries/Tagmanager/Page.php';

class Forum_Tags extends TagManager
{
	/* ------------------------------------------------------------------------------------------------------------- */
	
	/**
	 * @var array URL segments
	 */
	public static $segments = array();
	
	/* ------------------------------------------------------------------------------------------------------------- */
	
	/**
	 * @var string Forum url segment
	 */
	public static $forum = "";
	
	/**
	 * @var string Topic url segment
	 */
	public static $topic = "";
	
	/**
	 * @var string Post url segment
	 */
	public static $post = "";
	
	/* ------------------------------------------------------------------------------------------------------------- */
	
	public static $ci = null;
	
	/* ------------------------------------------------------------------------------------------------------------- */
	
    /**
     * Tags declaration
     * To be available, each tag must be declared in this static array.
     *
     * @var array
     *
     */
    public static $tag_definitions = array
    (
        	"forum"									=>	"index",    	
    		"forum:toolbar"							=>	"tag_toolbar",
    		"forum:breadcrumb"						=>	"tag_breadcrumb",
    		
    		"forum:forums"							=>	"tag_forum",
    		"forum:forums:contents"					=>	"tag_forum_contents",
    		"forum:forums:empty"					=>	"tag_forum_empty",
    		
    		"forum:topic"							=>	"tag_topic",
    		"forum:topic:empty"						=>	"tag_topic_empty",
    );
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    public static function initialize()
    {    	
    	self::$ci =& get_instance();
    	
    	// Get the current forum url and get the forum/topic url segments
    	$url = self::$ci->uri->uri_string(); $current_page = TagManager_Page::get_current_page();
    	$url = str_replace("/{$current_page['url']}",'', $url);
    	
    	// Saving the url segments and unset the empty segment
    	self::$segments = explode('/', $url); if(self::$segments[0] == "") unset(self::$segments[0]);
    	
    	if(isset(self::$segments[1])) self::$forum = self::$segments[1];
    	if(isset(self::$segments[2])) self::$topic = self::$segments[2];
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */

    public static function index(FTL_Binding $tag)
    {	
    	$cache = $tag->getAttribute('cache', TRUE);
    	self::initialize();
    	
    	// If cached then return cached return value
    	if ($cache == TRUE && ($str = self::get_cache($tag)) !== FALSE) return $str;
    	
    	// Get ion:tag variables
    	$id = $tag->getAttribute('id'); $class = $tag->getAttribute('class');
    	$attr = $tag->getAttribute('attr'); $parent = $tag->getAttribute('tag');
    	
    	$str = ""; // Create the output
    	
    	if($attr != "") $attr = " $attr"; // Adding custom attribute to tag 
    	if($id != "") $id = ' id="'.$id.'"'; // Adding id to the tag
    	if($class != "") $class = ' class="'.$class.'"'; // Adding classes
    	if($parent != "") $str .= "<{$parent}{$id}{$class}{$attr}>"; // Adding parent tag
    	
    	/* ----------------------------------------------------------------- */
    	
    	$current_page = TagManager_Page::get_current_page();
    	$base_url = $current_page['absolute_url'];
    	
    	$tag->set('version', 'v2.0.0');
    	$tag->set('name', 'forum');
    	$tag->set('url', $base_url);
    	
    	$str .= $tag->expand(); // Expand the ion:tag
    	
    	/* ----------------------------------------------------------------- */
    	
    	if($parent != "") $str .= "</{$parent}>"; // Closing parent tag
    	// Set the cached return value
    	self::set_cache($tag, $str);    	
        return $str; // and return 	
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    public static function tag_toolbar(FTL_Binding $tag)
    {
    	$cache = $tag->getAttribute('cache', TRUE);
    	self::$ci =& get_instance();
    	 
    	// If cached then return cached return value
    	if ($cache == TRUE && ($str = self::get_cache($tag)) !== FALSE) return $str;
    	 
    	// Get ion:tag variables
    	$id = $tag->getAttribute('id'); $class = $tag->getAttribute('class');
    	$attr = $tag->getAttribute('attr'); $parent = $tag->getAttribute('tag');
    	$buttons_class = $tag->getAttribute('buttons_class');
    	 
    	$str = ""; // Create the output
    	 
    	if($attr != "") $attr = " $attr"; // Adding custom attribute to tag
    	if($id != "") $id = ' id="'.$id.'"'; // Adding id to the tag
    	if($class != "") $class = ' class="'.$class.'"'; // Adding classes
    	if($parent != "") $str .= "<{$parent}{$id}{$class}{$attr}>"; // Adding parent tag
    	 
    	// Get the logged user role
    	$user_role = User()->get_role();
    	 
    	/* --------------------------------------------------------------------------------------------------------- */
    	
    	// @todo: permission check
    	if($user_role['role_level'] >= 5000)
    	{
	    	$buttons_classes = ' class="forum create '.$buttons_class.'"';
	    	$str .= '<button '.$buttons_classes.' onclick="Forum.create(\'forum\')">'.lang("create_forum").'</button>';
    	}
    	
    	// @todo: permission check
    	if($user_role['role_level'] >= 5000)
    	{
	    	$buttons_classes = ' class="topic create '.$buttons_class.'"';
	    	$str .= '<button '.$buttons_classes.' onclick="Forum.create(\'topic\')">'.lang("create_topic").'</button>';
    	}
    	
    	// @todo: permission check
    	if($user_role['role_level'] >= 5000)
    	{
	    	$buttons_classes = ' class="post create '.$buttons_class.'"';
	    	$str .= '<button '.$buttons_classes.' onclick="Forum.create(\'post\')">'.lang("create_post").'</button>';
    	}
    	
    	$str .= $tag->expand(); // Expand the ion:tag
    	
    	/* --------------------------------------------------------------------------------------------------------- */    	
    	
    	// Assign the forum forms
    	$assing_variables = array
    	(
    			'forum_form' => self::$ci->load->view('form_forum', null, true),
    			'topic_form' => self::$ci->load->view('form_topic', null, true),
    			'post_form' => self::$ci->load->view('form_post', null, true)
    	);
    	
    	// Append the forum functions script file
    	$str .= self::$ci->load->view('functions', $assing_variables, true);
    	
    	/* --------------------------------------------------------------------------------------------------------- */
    	
    	if($parent != "") $str .= "</{$parent}>"; // Closing parent tag
    	// Set the cached return value
    	self::set_cache($tag, $str);
    	return $str; // and return
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    public static function tag_breadcrumb(FTL_Binding $tag)
    {
    	$cache = $tag->getAttribute('cache', TRUE);
    	
    	// If cached then return cached return value
    	if ($cache == TRUE && ($str = self::get_cache($tag)) !== FALSE) return $str;
    	
    	// Get ion:tag variables
    	$id = $tag->getAttribute('id'); $class = $tag->getAttribute('class');
    	$attr = $tag->getAttribute('attr'); $parent = $tag->getAttribute('tag');
    	
    	$str = ""; // Create the output
    	
    	if($attr != "") $attr = " $attr"; // Adding custom attribute to tag
    	if($id != "") $id = ' id="'.$id.'"'; // Adding id to the tag
    	if($class != "") $class = ' class="'.$class.'"'; // Adding classes
    	if($parent != "") $str .= "<{$parent}{$id}{$class}{$attr}>"; // Adding parent tag
    	
    	/* ----------------------------------------------------------------- */
    	
    	// @todo tag
    	
    	/* ----------------------------------------------------------------- */
    	
    	if($parent != "") $str .= "</{$parent}>"; // Closing parent tag
    	// Set the cached return value
    	self::set_cache($tag, $str);
    	return $str; // and return
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    public static function tag_forum(FTL_Binding $tag)
    {
    	$cache = $tag->getAttribute('cache', TRUE);
    	// Load the codeigniter class and load the forum model
    	self::$ci =& get_instance(); self::$ci->load->model('forum_model');
    	 
    	// If cached then return cached return value
    	if ($cache == TRUE && ($str = self::get_cache($tag)) !== FALSE) return (self::$topic=="" ? $str : '');
    	 
    	// Get ion:tag variables
    	$class = $tag->getAttribute('class');
    	$attr = $tag->getAttribute('attr');
    	$parent = $tag->getAttribute('tag');
    	if($parent == "") $parent = "div";
    	
    	// Get the parent url
    	$current_page = TagManager_Page::get_current_page();
    	$base_url = $current_page['absolute_url'];
    	 
    	$str = ""; // Create the output
    	 
    	if($attr != "") $attr = " $attr"; // Adding custom attribute to tag
    	if($class != "") $class = ' class="'.$class.'"'; // Adding classes
    	$str .= "<{$parent} id=\"forum-ajax-container\"{$class}{$attr}>"; // Adding parent tag
    	 
    	/* ----------------------------------------------------------------- */
    	
    	// Get forums from the database    	
    	if(self::$forum != "") self::$ci->forum_model->where('url', self::$forum);    	
    	$forums = self::$ci->forum_model->get_forums();
    	
    	// If has forum to itelarate
    	if($forums != FALSE && $forums->num_rows() > 0)
    	{
    		foreach($forums->result() as $row)
    		{
    			$tag->set('id', $row->id_forum);
    			$tag->set('name', $row->code);
    			
    			$forum_url = $base_url.'/'.$row->url;
    			$tag->set('url', $forum_url);
    			$tag->set('link', $forum_url);
    			
    			$tag->set('title', $row->title);
    			$tag->set('subtitle', $row->preview);
    			$tag->set('description', $row->description);    			
    			$tag->set('forum', (array) $row);
    			
    			// Get topics from the database
    			$topics = self::$ci->forum_model->get_topics($row->id_forum);
    			$topics_array = array();
    			
    			// If has topics to itelarate
    			if($topics != FALSE && $topics->num_rows() > 0)
    			{
    				foreach($topics->result() as $topic)
    				{
    					$_topic = array();
    					
    					$_topic['id'] = $topic->id_topic;
    					$_topic['url'] = $forum_url.'/'.$topic->url;
    					$_topic['link'] = $forum_url.'/'.$topic->url;
    					$_topic['title'] = $topic->title;
    					$_topic['description'] = $topic->description;
    					$_topic['posts'] = $topic->posts;
    					$_topic['last_posted'] = $topic->last_posted;
    					$_topic['topic'] = (array) $topic;
    			
    					$topics_array[] = $_topic;
    				}
    			}    			
    			$tag->set('topics', $topics_array);
    			
    			// Get the logged user role
    			$user_role = User()->get_role();
    			    			
    			// Edit forum button @todo permission check
    			if($user_role['role_level'] >= $row->level_moderator || $user_role['role_level'] >= 5000)
    			{
    				$edit_forum_button  = '<button class="forum edit button tiny secondary"';
    				$edit_forum_button .= ' onclick="'."Forum.edit('forum', '{$row->id_forum}');".'">';
    				$edit_forum_button .= lang('edit_forum');
    				$edit_forum_button .= '</button>';
    			}
    			
    			// Open topic button @todo permission check
    			if($user_role['role_level'] >= $row->level_open || $user_role['role_level'] >= 5000)
    			{
    				$open_topic_button  = '<button class="topic open button tiny secondary"';
    				$open_topic_button .= ' onclick="'."Forum.create('topic', '{$row->id_forum}');".'">';
    				$open_topic_button .= lang('open_topic');
    				$open_topic_button .= '</button>';
    			}
    			
    			$tag->set('edit_forum', (isset($edit_forum_button)?$edit_forum_button:''));
    			$tag->set('open_topic', (isset($open_topic_button)?$open_topic_button:''));
    			
    			$str .= $tag->expand(); // Expand the ion:tag
    		}
    	}
    	else
    	{
    		return '<div class="alert-box alert">'.lang('404_forum_not_found').'</div>';
    	}
    	
    	/* ----------------------------------------------------------------- */
    	
    	$str .= "</{$parent}>"; // Closing parent tag
    	
    	// Wrap outside the ion:tag and set the cache
    	$output = self::wrap($tag, $str); self::set_cache($tag, $output);
    	
    	return (self::$topic=="" ? $output : ''); // return the tag if is forum view
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    public static function tag_forum_empty(FTL_Binding $tag)
    {
    	$topics = $tag->get('topics'); // Get parent topics array    	
    	if(count($topics) == 0) return $tag->expand();    	
    	return '';
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    public static function tag_topic(FTL_Binding $tag)
    {
    	$cache = $tag->getAttribute('cache', TRUE);
    	// Load the codeigniter class and load the forum model
    	self::$ci =& get_instance(); self::$ci->load->model('forum_model');
    	
    	// If cached then return cached return value
    	if ($cache == TRUE && ($str = self::get_cache($tag)) !== FALSE) return (self::$topic != '' ? $str : '');
    	
    	// Get ion:tag variables
    	$class = $tag->getAttribute('class');
    	$attr = $tag->getAttribute('attr');
    	$parent = $tag->getAttribute('tag');
    	if($parent == "") $parent = "div";
    	 
    	// Get the parent url
    	$current_page = TagManager_Page::get_current_page();
    	$base_url = $current_page['absolute_url'];
    	
    	$str = ""; // Create the output
    	
    	if($attr != "") $attr = " $attr"; // Adding custom attribute to tag
    	if($class != "") $class = ' class="'.$class.'"'; // Adding classes
    	$str .= "<{$parent} id=\"forum-ajax-container\"{$class}{$attr}>"; // Adding parent tag
    	
    	/* ----------------------------------------------------------------- */
    	 
    			 // Get forum from the database
    			 self::$ci->forum_model->where('url', self::$forum);
    	$forum = self::$ci->forum_model->get_forums();
    	
    			 // Get the topic from the database
    		     self::$ci->forum_model->where('url', self::$topic);
    	$topic = self::$ci->forum_model->get_topics();
    	 
    	
    	if($topic != FALSE && $topic->num_rows() > 0)
    	{
    		$row = $topic->row();
    		$tag->set('id', $row->id_topic);
    		$tag->set('url', $base_url.'/'.$row->forum_url.'/'.$row->url);
    		$tag->set('title', $row->title);
    		$tag->set('description', $row->description);
    		$tag->set('topic', (array) $row);
    		
    		// Get the posts from the database
    		$posts = self::$ci->forum_model->get_posts($row->id_topic);    		
    		$posts_array = array();
    		
    		if($posts != FALSE && $posts->num_rows() > 0)
    		{
    			foreach($posts->result() as $post)
    			{
    				$_post = array();
    				
    				$_post['id'] = $post->id_post;
    				$_post['posted'] = $post->posted;
    				
    				$_poster = array();
    				
	    				$_poster['id'] = $post->id_user;
	    				$_poster['username'] = $post->user_username;
	    				$_poster['screen_name'] = $post->user_screen_name;
	    				$_poster['last_visit'] = $post->user_lastvisit;
	    				$_poster['registered'] = $post->user_joindate;
	    				$_poster['firstname'] = $post->user_firstname;
	    				$_poster['lastname'] = $post->user_lastname;
	    				$_poster['email'] = $post->user_email;
	    				$_poster['role_level'] = $post->user_role_level;
	    				$_poster['role_name'] = $post->user_role_name;
	    				$_poster['role_code'] = $post->user_role_code;
	    				$_poster['role_description'] = $post->user_role_description;
	    				
	    				$_poster['avatar'] = "";
	    				$_poster['post_count'] = $post->user_post_count;
    				
    				$_post['poster'] = $_poster;
    				
    				$_post['content'] = $post->post;
    				
    				$posts_array[] = $_post;
    			}
    		}
    		$tag->set('posts', $posts_array);
    		
    		// Get the logged user role
    		$user = User()->get_user();
    		
    		// Edit topic button @todo permission check
    		if($user['id_user'] == $row->id_owner || $user['role_level'] >= 5000)
    		{
    			$edit_topic_button  = '<button class="topic edit button tiny secondary"';
    			$edit_topic_button .= ' onclick="'."Forum.edit('topic', '{$row->id_topic}');".'">';
    			$edit_topic_button .= lang('edit_topic');
    			$edit_topic_button .= '</button>';
    		}
    		 
    		// Post reply button @todo permission check
    		if($user['role_level'] >= $row->level_write || $user['role_level'] >= 5000)
    		{
    			$post_reply_button  = '<button class="reply post button tiny secondary"';
    			$post_reply_button .= ' onclick="'."Forum.create('post', '{$row->id_topic}');".'">';
    			$post_reply_button .= lang('post_reply');
    			$post_reply_button .= '</button>';
    		}
    		 
    		$tag->set('edit_topic', (isset($edit_topic_button)?$edit_topic_button:''));
    		$tag->set('post_reply', (isset($post_reply_button)?$post_reply_button:''));
    		
    		$str .= $tag->expand(); // Expand the ion:tag
    	}
    	else
    	{
    		return (self::$topic != '' ? '<div class="alert-box alert">'.lang('404_topic_not_found').'</div>' : '');
    	}
    	
    	/* ----------------------------------------------------------------- */
    	 
    	$str .= "</{$parent}>"; // Closing parent tag
    	 
    	// Wrap outside the ion:tag and set the cache
    	$output = self::wrap($tag, $str); self::set_cache($tag, $output);
    	 
    	return (self::$topic != '' ? $output : ''); // return the tag if is forum view
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    public static function tag_topic_empty(FTL_Binding $tag)
    {
    	$posts = $tag->get('posts'); // Get parent posts array    	 
    	if(count($posts) == 0) return $tag->expand();
    	return '';
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
}
