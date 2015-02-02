<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Forum extends My_Controller {

    public function __construct() {
    
        parent::__construct();
        
    }
 
    function index() {
    
        print "Demo module default controller output";
        
    }
}
