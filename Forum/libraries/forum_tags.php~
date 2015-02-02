<?php

class Forum_Tags extends TagManager {

    /**
     * Tags declaration
     * To be available, each tag must be declared in this static array.
     *
     * @var array
     *
     */
<<<<<<< HEAD
    public static $tag_definitions = array(
        "forum" => "index",
        "forum_breadcrumb" => "tag_breadcrumb", // Navigator breadcrumb
        "forum:main" => "tag_main", // Main screen tag
        "forum:main:forums" => "tag_forums", // Main screen forum list
        "forum:main:admin" => "tag_admin",
        "forum:admin" => "tag_admin",
        "forum:admin:main" => "tag_main",
        "forum:admin:main:forums" => "tag_forums",
        "forum:forum" => "tag_forum", // Forum screen tag
        "forum:forum:topics" => "tag_topics", // Forum screen topics list
        "forum:forum:can_open" => "tag_forum_can_open", // Can open topic permission
        "forum:topic" => "tag_topic", // Topic screen tag
        "forum:topic:posts" => "tag_posts", // Topic screen posts list
        "forum:topic:bbcode_script" => "bbcode_script", // BBcode script...        
        "forum:last_posts" => "tag_last_posts", // Lattest posts list
        "forum:last_topics" => "tag_last_topics", // Lattest updated topics list
        "forum:top_topics" => "tag_top_topics", // Top topicst list
        "forum:top_forums" => "tag_top_forums", // Top forums list
        "forum:top_users" => "tag_top_users"             // Forum top users list
    );

    public static function index(FTL_Binding $tag) {
        $str = $tag->expand();
        return $str;
    }

    public function bbcode_script(FTL_Binding $tag) {

        return '<script type="text/javascript" src="/modules/Forum/assets/js/bbcode.js"></script>';
    }

    public function tag_breadcrumb(FTL_Binding $tag) {

        self::$ci->load->helper('colorcode');

        $sep = $tag->getAttribute('separator');
        $data = $tag->get($tag->getParentName());

        $url = str_replace($data['path'], "", self::$ci->uri->uri_string());

        $segments = explode('/', $url);

        //return '<pre>'.print_r($segments, true).'</pre>';
        //return count($segments);

        if ($sep == "")
            $sep = " &raquo; ";

        $forum = $topic = $str = "";

        self::load_model('forum_model');

        $str = '<a href="/' . $data['path'] . '"> Fórum kezdőoldal </a> ';

        if (count($segments) >= 2) {
            $forum = self::$ci->forum_model->get_forum(array('url' => $segments[1]))->row();
            $str .= $sep . ' <a href="/' . $data['path'] . '/' . $forum->url . '"> ' . colorize($forum->title) . ' </a> ';
        }

        if (count($segments) >= 3) {
            $topic = self::$ci->forum_model->get_topic(array('url' => $segments[2]))->row();
            $str .= $sep . ' <a href="/' . $data['path'] . '/' . $forum->url . '/' . $topic->url . '"> ' . colorize($topic->title) . ' </a> ';
        }

        return $str;
    }

    public function tag_admin(FTL_Binding $tag) {

        $user = (object) User()->get_user();

        $user_level = 20;

        if (count((array) $user) > 0)
            $user_level = $user->role_level;
        
        if($user_level >= 5000) {
            
            return $tag->expand();
            
        } else {
            
            return '';
            
        }
        
    }

    public function tag_main(FTL_Binding $tag) {

        $str = "";

        $segments = explode('/', self::$ci->uri->uri_string());

        if (!isset($segments[1])) {

            self::load_model('forum_model');

            $forums = self::$ci->forum_model->get_forum(array('parent' => 0))->result();

            if (is_array($forums)) {

                foreach ($forums as $forum) {

                    $tag->set('forum_id', $forum->id_forum);
                    $tag->set('id', $forum->id_forum);
                    $tag->set('title', $forum->title);
                    $tag->set('description', $forum->description);
                    //$tag->set('num_forums', 0); 

                    $tag->set('num_forums', self::$ci->forum_model->get_forum(array('parent' => $forum->id_forum))->num_rows());
                    $tag->set('num_topics', self::$ci->forum_model->get_topic(array('id_forum' => $forum->id_forum))->num_rows());

                    $tag->set('forums', $tag->expand());

                    $str .= $tag->expand();
                }

                return $str;
            }
        } else {

            return $str;
        }
    }

    public function tag_forums(FTL_Binding $tag) {

        $str = "";
        self::load_model('forum_model');

        $parent = $tag->get('id');

        $forums = self::$ci->forum_model->get_forum(array('parent' => $parent))->result();

        if (is_array($forums)) {

            //echo "<pre>".print_r($forums, true)."</pre>";

            self::$ci->load->helper('text');
            self::$ci->load->helper('colorcode');

            foreach ($forums as $forum) {
                
                $tag->set('forum_id', $forum->id_forum);

                $tag->set('title', colorize($forum->title));
                $tag->set('link', $forum->url);

                $tag->set('description', colorize($forum->description));

                $tag->set('preview', colorize($forum->preview));

                $tag->set('icon', '/modules/Forum/assets/icons/32x32/' . $forum->icon . '.png');

                //$tag->set('num_forums', self::$ci->forum_model->get_forum(array('parent' => $parent))->num_rows());
                //$tag->set('num_topics', self::$ci->forum_model->get_topic(array('id_forum' => $parent))->num_rows());

                $tag->set('num_forums', $forum->num_forums);
                $tag->set('num_topics', $forum->num_topics);

                if ($forum->last_user != 0) {

                    $user = self::$ci->forum_model->get_user(array('id_user' => $forum->last_user))->row();
                    $tag->set('last_username', $user->username);
                } else {

                    $tag->set('last_username', 'anonymous');
                }

                if ($forum->last_topic != 0) {

                    $topic = self::$ci->forum_model->get_topic(array('tp.id_topic' => $forum->last_topic))->row();

                    $tag->set('last_topic', character_limiter($topic->title, 12));
                    $tag->set('last_topic_url', $topic->url);
                } else {

                    $tag->set('last_topic', '');
                    $tag->set('last_topic_url', '');
                }

                $tag->set('last_date', $forum->last_date);
                $tag->set('last_time', $forum->last_time);

                $str .= $tag->expand();
            }

            return $str;
        }
    }

    public function tag_forum(FTL_Binding $tag) {

        $str = "";

        $segments = explode('/', self::$ci->uri->uri_string());

        if (isset($segments[1]) && !isset($segments[2])) {

            $url = $segments[1];

            self::load_model('forum_model');

            $forums = self::$ci->forum_model->get_forum(array('url' => $url))->result();

            if (is_array($forums)) {

                self::$ci->load->helper('colorcode');

                foreach ($forums as $forum) {

                    $tag->set('forum_id', $forum->id_forum);
                    $tag->set('link', $forum->url);
                    $tag->set('title', colorize($forum->title));
                    $tag->set('description', colorize($forum->description));
                    $tag->set('num_topics', $forum->num_topics);


                    $tag->set('topics', $tag->expand());

                    $str .= $tag->expand();
                }

                return $str;
            } else {

                return "forum not found in database";
            }
        } else {

            return $str;
        }
    }

    public function tag_forum_can_open(FTL_Binding $tag) {

        $str = "";

        $forum_id = $tag->get('forum_id');

        if (is_numeric($forum_id)) {

            self::load_model('forum_model');

            $user = (object) User()->get_user();

            $user_level = 20;

            if (count((array) $user) > 0)
                $user_level = $user->role_level;

            $forum = self::$ci->forum_model->get_forum(array('fp.id_forum' => $forum_id))->row();

            if ($user_level >= $forum->level_open) {
                $str = $tag->expand();
            }
        }

        return $str;
    }

    public function tag_topics(FTL_Binding $tag) {

        $str = "";

        self::load_model('forum_model');

        $lang = Settings::get_lang();

        $forum = $tag->get('forum_id');

        $topics_list = self::$ci->forum_model->get_topic(array('id_forum' => $forum))->result();

        //$str = "<pre>";
        //$str .= "id_forum => $forum \n";
        //$str .= "lang => $lang \n";
        //$str .= "topics_list => ".print_r($topics_list, TRUE);
        //$str .= "</pre>";
        //return $str;

        $link = $tag->get('link');

        self::$ci->load->helper('colorcode');

        foreach ($topics_list as $topic) {

            $user = self::$ci->forum_model->get_user(array('id_user' => $topic->last_user))->row();

            $tag->set('topic_id', $topic->id_topic);
            $tag->set('title', colorize($topic->title));
            $tag->set('link', $link . "/" . $topic->url);
            $tag->set('icon', '/modules/Forum/assets/icons/32x32/comment_box.png');
            $tag->set('num_posts', $topic->num_posts);
            $tag->set('last_date', $topic->last_date);
            $tag->set('last_time', $topic->last_time);
            $tag->set('last_username', $user->username);

            $str .= $tag->expand();
        }

        return $str;
    }

    public function tag_topic(FTL_Binding $tag) {

        $str = "";
        $segments = explode('/', self::$ci->uri->uri_string());

        if (isset($segments[1]) && isset($segments[2])) {

            self::load_model('forum_model');

            self::$ci->load->helper('colorcode');

            $topic = self::$ci->forum_model->get_topic(array('url' => $segments[2]))->row();

            $tag->set('topic_id', $topic->id_topic);
            $tag->set('title', colorize($topic->title));
            $tag->set('num_posts', $topic->num_posts);
            $tag->set('posts', $tag->expand());

            $str .= $tag->expand();
        }

        return $str;
    }

    public function tag_posts(FTL_Binding $tag) {

        $str = "";
        self::load_model('forum_model');

        $topic_id = $tag->get('topic_id');

        $posts = self::$ci->forum_model->get_post(array('id_topic' => $topic_id))->result();

        $posts_num = self::$ci->forum_model->get_post(array('id_topic' => $topic_id))->num_rows();

        $number = $posts_num;

        foreach ($posts as $post) {

            $user = self::$ci->forum_model->get_user(array('id_user' => $post->id_user))->row();

            $online = (object) User()->get_user();

            self::$ci->load->helper('smiley');
            self::$ci->load->helper('bbcode');

            $tag->set('id', $post->id_post);
            $tag->set('user_id', $post->id_user);
            $tag->set('post_date', $post->time);
            $tag->set('username', $user->username);
            $tag->set('content', parse_bbcode(parse_smileys($post->content, "/".Theme::get_theme_path()."/images/smileys/")));
            $tag->set('number', $number--);

            $count = self::$ci->forum_model->get_post(array('id_user' => $post->id_user))->num_rows();

            $tag->set("user_posts", $count);

            if (count((array) $online) > 0) {

                if ($online->id_user == $post->id_user) {

                    $tag->set('permission', 'true');
                } else {

                    $tag->set('permission', 'false');
                }
            } else {

                $tag->set('permission', 'false');
            }

            $str .= $tag->expand();
        }

        return $str;
    }

}

=======
    public static $tag_definitions = array (
        "forum:main" => "tag_main",
        "forum:main:forums" => "tag_forums",
        "forum:topics" => "tag_topics"
    );
    
    public static function index(FTL_Binding $tag)
    {
        $str = $tag->expand();
        return $str;
    }    
    
    public function tag_main(FTL_Binding $tag) {
    
        $str = "";
        
        $segments = explode('/', self::$ci->uri->uri_string());
      
      if(!isset($segments[1])) {
        
           self::load_model('forum_model');
           
           $forums = self::$ci->forum_model->get_forums_list(array('parent' => 0))->result();
    
           if(is_array($forums)) {
    
              foreach($forums as $forum) {
              
                  $tag->set('id', $forum->id_forum);               
                  $tag->set('title', $forum->title);
                  $tag->set('description', $forum->description);
                  $tag->set('num_forums', $forum->num_forums);
                  $tag->set('num_topics', $forum->num_topics);
                  
                  $tag->set('forums', $tag->expand());
                     
                  $str .= $tag->expand();
              }
       
              return $str;
       
           }
       
       } else {
       
         return $str;
       
       }
    
    }
    
    public function tag_forums(FTL_Binding $tag) {
    
        $str = ""; self::load_model('forum_model');
        
        $parent = $tag->get('id');        
        
        $forums = self::$ci->forum_model->get_forums_list(array('parent' => $parent))->result();
 
        if(is_array($forums)) {
 
           foreach($forums as $forum) {
               
               $tag->set('title', $forum->title);               
               $tag->set('link', $forum->url);
               $tag->set('description', $forum->description);
               $tag->set('num_forums', $forum->num_forums);
               $tag->set('num_topics', $forum->num_topics);
                  
               $str .= $tag->expand();
           }
    
           return $str;
    
        }
    
    }  
    
    public function tag_topics(FTL_Binding $tag) {
      
      $str = "";
      
      $segments = explode('/', self::$ci->uri->uri_string());
      
      if(isset($segments[1])) {
      
         $url = $segments[1];
      
         self::load_model('forum_model');
           
           $forums = self::$ci->forum_model->get_forums_list(array('url' => $url))->result();
    
           if(is_array($forums)) {
    
              foreach($forums as $forum) {
              
                  $tag->set('id', $forum->id_forum);               
                  $tag->set('title', $forum->title);
                  $tag->set('description', $forum->description);
                  $tag->set('num_topics', $forum->num_forums);
                  
                  //$tag->set('topics', $tag->expand());
                     
                  $str .= $tag->expand();
              }
       
              return $str;
       
           } else {
            
              return "forum not found in database"; 
            
           }
      
      } else {
      
         return $str;
      
      } 
      
    }  
 
}
>>>>>>> 4ae6aa2d69d20f8634497f4a14fd3fa10765db2a
