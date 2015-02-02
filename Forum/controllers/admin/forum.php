<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * Module Admin controller
 *
 */
class Forum extends Module_Admin {
    /**
     * Constructor
     *
     * @access  public
     * @return  void
     */
    public function construct() {
    
      $config = array();    
      include MODPATH."Forum/config/config.php";
    
    }
 
    /**
     * Admin panel
     * Called from the modules list.
     *
     * @access  public
     * @return  parsed view
     *
     */
    public function index() {
    
        $config = array();    
        include MODPATH."Forum/config/config.php";
        
        $this->template['config'] = $config['module']['forum'];
    
        $this->output('admin/forum');
        
    }
}
