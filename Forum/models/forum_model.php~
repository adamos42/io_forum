<?php

class Forum_model extends CI_Model {
   
   public function __construct() {
      parent::__construct();
   }
   
<<<<<<< HEAD
   /**
    * Fórum lista
    *
    */
   public function get_forum($where="", $lang="") {
   
      if($lang == "")       
        $lang = Settings::get_lang();
=======
   public function get_forums_list($where="") {
   
      $lang = Settings::get_lang();
>>>>>>> 4ae6aa2d69d20f8634497f4a14fd3fa10765db2a
      
      $this->db->select("
            fp.*,
            fpl.*,
<<<<<<< HEAD
            UNIX_TIMESTAMP( fp.last_date ) AS last_time
=======
>>>>>>> 4ae6aa2d69d20f8634497f4a14fd3fa10765db2a
         ")->from("forums AS fp");
         
      $this->db->join("forums_lang AS fpl", "fp.id_forum = fpl.id_forum AND fpl.lang = '$lang'");
      
      if(is_array($where)) {
         foreach($where as $name => $value) {
            $this->db->where($name, $value);
         }
      }
      
<<<<<<< HEAD
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
   
=======
      return $this->db->get();   
   }
   
>>>>>>> 4ae6aa2d69d20f8634497f4a14fd3fa10765db2a
}
