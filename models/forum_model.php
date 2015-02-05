<?php

class Forum_model extends CI_Model
{
	/* ------------------------------------------------------------------------------------------------------------- */
	
	/**
	 * @var string Current language code
	 */
	private $lang = 'en';
	
	/* ------------------------------------------------------------------------------------------------------------- */
	
	private $filter_lang = array('forum','forum_topic');
	
	/* ------------------------------------------------------------------------------------------------------------- */
	
   	public function __construct()
   	{
    	parent::__construct(); // Construct parent class
    	
    	// Get the language code from the Settings
    	$this->lang = Settings::get_lang();
   	}
   	
   	/* ------------------------------------------------------------------------------------------------------------- */
   	
   	public function where($name, $value, $formatting=TRUE)
   	{
   		$this->db->where($name, $value, $formatting);
   		return $this;
   	}
   	
   	/* ------------------------------------------------------------------------------------------------------------- */
   	
   	public function get($table="module_forum")
   	{
   		// Filter language if possible
   		if(in_array($table, $this->filter_lang)) $this->db->where('lang', $this->lang);
   		
   		// Run the database query
   		$query = $this->db->from($table)->get();
   		
   		//echo "<pre>".$this->db->last_query()."</pre>";
   		
   		// Return database object
   		return $query;
   	}
   	
   	/* ------------------------------------------------------------------------------------------------------------- */
   	
   	public function get_forums()
   	{
   		return $this->get('forum');
   	}
   	
   	/* ------------------------------------------------------------------------------------------------------------- */
   	
   	public function get_topics($id_forum=NULL)
   	{
   		if($id_forum != NULL) $this->db->where('id_forum', $id_forum);   		
   		return $this->get('forum_topic');
   	}
   	
   	/* ------------------------------------------------------------------------------------------------------------- */
   	
   	public function get_posts($id_topic=NULL)
   	{
   		if($id_topic != NULL) $this->db->where('id_topic', $id_topic);
   		return $this->get('forum_post');
   	}
   	
   	/* ------------------------------------------------------------------------------------------------------------- */
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   	
   
   /**
    * Fórum lista
    *
    */
   public function get_forum($where="", $lang="") {
   
      if($lang == "")       
        $lang = Settings::get_lang();
      
      $this->db->select("
            fp.*,
            fpl.*,
            UNIX_TIMESTAMP( fp.last_date ) AS last_time
         ")->from("forums AS fp");
         
      $this->db->join("forums_lang AS fpl", "fp.id_forum = fpl.id_forum AND fpl.lang = '$lang'");
      
      if(is_array($where)) {
         foreach($where as $name => $value) {
            $this->db->where($name, $value);
         }
      }
      
      $user = (object) User()->get_user();
      
      if(count( (array) $user) > 0) {
         $role_level = $user->role_level;
      } else {
         $role_level = 20;
      }     
      
      $this->db->where("level_read <", $role_level);
      
      $this->db->order_by("parent", "asc");      
      $this->db->order_by("order", "asc");
      
      return $this->db->get();   
   }
   
   /**
    * Topic lista
    *
    */
   public function get_topic($where="") {
   
      $lang = Settings::get_lang();
      
      $this->db->select("
            tp.*,
            tpl.*,
            UNIX_TIMESTAMP( tp.last_date ) AS last_time
         ")->from("forum_topics AS tp");
         
      $this->db->join("forum_topics_lang AS tpl", "tp.id_topic = tpl.id_topic AND tpl.lang = '$lang'");
      
      if(is_array($where)) {
         foreach($where as $name => $value) {
            $this->db->where($name, $value);
         }
      }
      
      $this->db->order_by("last_date", "desc");
      
      return $this->db->get();
   }
   
   /**
    * Post lista
    *
    */
   public function get_post($where="") {
      
      $this->db->select("
      
         id_post,
         id_topic,
         id_user,
         date,
         UNIX_TIMESTAMP(date) AS time,
         content,
         edited_by,
         edited_was,
         UNIX_TIMESTAMP(edited_was) AS edited_time
      
      
      ")->from("forum_posts");
      
      if(is_array($where)) {
         foreach($where as $name => $value) {
            $this->db->where($name, $value);
         }
      }
      
      $this->db->order_by('date', 'desc');
      
      return $this->db->get();
   }
   
   
   public function get_user($where="") {
      
      $this->db->select("*")->from("user as usr");
      $this->db->join('role AS rl', 'usr.id_role = rl.id_role');
      
      if(is_array($where)) {
         foreach($where as $name => $value) {
            $this->db->where($name, $value);
         }
      }      
      
      return $this->db->get();
   }
   
   /**
    * Új topic
    *
    */
   public function new_topic($forum, $user, $lang, $title, $description="") {
      
      $this->db->insert('forum_topics', array(      
         'id_forum' => $forum,
         'id_owner' => $user
      ));
      
      $topic = $this->db->insert_id();
            
      $this->db->insert('forum_topics_lang', array(
         'lang' => $lang,
         'id_topic' => $topic,
         'title' => $title,
         'url' => url_title($title),
         'description' => $description
      ));      
      
      return $topic;      
   }
   
   /**
    * Új hozzászólás
    *
    */
   public function new_post($topic, $user, $content) {
      
      $this->db->insert('forum_posts', array(
         'id_topic' => $topic,
         'id_user' => $user,
         'content' => $content
      ));
      
   }
   
   public function new_forum($data, $lang_data) {
       
       $this->db->insert('forums', $data);
       
       $lang_data['id_forum'] = $this->db->insert_id();
       
       $this->db->insert('forums_lang', $lang_data);
       
   }
   
   public function edit_forum($forum_id, $data, $lang_data) {
       
       $this->db->where('id_forum', $forum_id);
       $this->db->update('forums', $data); 
       
       $this->db->where('id_forum', $forum_id);
       $this->db->update('forums_lang', $lang_data);
       
   }
   
}
