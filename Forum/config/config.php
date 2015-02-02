<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
$config['module']['forum'] = array
(
    'module' => "Forum",
    'name' => "Forum Module",
    'description' => "Forum module, still development! Check the updates on https://github.com/adamos42/io_forum",
    'author' => "adamos42",
    'version' => "0.1.0",
 
    // 'uri' should be the module's folder in lowercase.
    // From 1.0.3, it is not mandatory to set 'uri'.
    
    'uri' => 'ajax_forum',
    'has_admin'=> TRUE,
    'has_frontend'=> TRUE,
);
 
return $config['module']['forum'];
