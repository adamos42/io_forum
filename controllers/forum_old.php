<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Forum extends My_Controller {

    public function __construct() {

        parent::__construct();
    }

    function index() {

        die("bad ajax request");
    }

    function new_topic() {

        $this->load->model('forum_model');
        $this->load->model('user_model');

        $user = (object) User()->get_user();

        $user_id = $user->id_user;
        $forum_id = $this->input->post('forum');
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $lang = $this->input->post('lang');

        $content = str_replace("\n", "<br/>", $content);

        $topic_id = $this->forum_model->new_topic($forum_id, $user_id, $lang, $title);

        $this->forum_model->new_post($topic_id, $user_id, $content);

        echo json_encode(array(
            'success' => true,
            'topic_id' => $topic_id
        ));
    }

    function new_post() {

        $this->load->model('forum_model');
        $this->load->model('user_model');

        $user = (object) User()->get_user();

        $user_id = $user->id_user;
        $topic_id = $this->input->post('topic');
        $content = $this->input->post('content');

        $content = str_replace("\n", "<br/>", $content);

        $this->forum_model->new_post($topic_id, $user_id, $content);

        echo json_encode(array(
            'success' => true
        ));
    }

    function new_forum() {

        $user = (object) User()->get_user();

        if (count((array) $user) > 0) {

            if ($user->role_level > 5000) {

                $data = $lang_data = array();

                $this->load->model('forum_model');

                $data["order"] = $this->input->post('order');
                $data["parent"] = $this->input->post('parent');
                $data["icon"] = $this->input->post('icon');
                $data["locked"] = $this->input->post('locked');
                $data["level_read"] = $this->input->post('read');
                $data["level_write"] = $this->input->post('write');
                $data["level_open"] = $this->input->post('open');
                $data["level_moderator"] = $this->input->post('moderator');

                $lang_data["preview"] = $this->input->post('preview');
                $lang_data["description"] = $this->input->post('description');
                $lang_data["title"] = $this->input->post('title');
                $lang_data["url"] = url_title($this->input->post('title'));
                $lang_data["lang"] = $this->input->post('lang');

                $lang_data["description"] = str_replace("\n", "<br/>", $lang_data["description"]);
                $lang_data["preview"] = str_replace("\n", "<br/>", $lang_data["preview"]);

                $this->forum_model->new_forum($data, $lang_data);

                echo json_encode(array(
                    'success' => true
                ));
            } else {

                echo json_encode(array(
                    'success' => false
                ));
            }
        } else {

            echo json_encode(array(
                'success' => false
            ));
        }
    }
    
    function edit_forum() {

        $user = (object) User()->get_user();

        if (count((array) $user) > 0) {

            if ($user->role_level > 5000) {

                $data = $lang_data = array();

                $this->load->model('forum_model');
                
                $forum_id = $this->input->post('forum_id');

                $data["order"] = $this->input->post('order');
                $data["parent"] = $this->input->post('parent');
                $data["icon"] = $this->input->post('icon');
                $data["locked"] = $this->input->post('locked');
                $data["level_read"] = $this->input->post('read');
                $data["level_write"] = $this->input->post('write');
                $data["level_open"] = $this->input->post('open');
                $data["level_moderator"] = $this->input->post('moderator');

                $lang_data["preview"] = $this->input->post('preview');
                $lang_data["description"] = $this->input->post('description');
                $lang_data["title"] = $this->input->post('title');
                $lang_data["url"] = url_title($this->input->post('title'));
                $lang_data["lang"] = $this->input->post('lang');

                $lang_data["description"] = str_replace("\n", "<br/>", $lang_data["description"]);
                $lang_data["preview"] = str_replace("\n", "<br/>", $lang_data["preview"]);

                $this->forum_model->edit_forum($forum_id, $data, $lang_data);

                echo json_encode(array(
                    'success' => true
                ));
                
            } else {

                echo json_encode(array(
                    'success' => false
                ));
                
            }
        } else {

            echo json_encode(array(
                'success' => false
            ));
        }
    }

    public function get_forum() {

        $user = (object) User()->get_user();

        if (count((array) $user) > 0) {

            if ($user->role_level > 5000) {

                $forum_id = $this->input->post('forum_id');
                $lang = $this->input->post('lang');
                
                $this->load->model('forum_model');
                
                $forum = $this->forum_model->get_forum(array("fp.id_forum" => $forum_id), $lang)->row();
                
                echo json_encode($forum);                
            }
        }
    }

}
