<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
$route['default_controller'] = "forum";
$route['(.*)'] = "forum/$1";
$route[''] = 'forum/index';
