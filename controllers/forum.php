<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 * 
 *
 */
class Forum extends My_Controller
{
	/* ------------------------------------------------------------------------------------------------------------- */
	
	/**
	 * @var $request JSON request array
	 */
	private $request = array();
	
	/**
	 * @var $params JSON request params array
	 */
	private $params = array();
	
	/**
	 * @var $response JSON response array
	 */
	private $response = array();	
	
	/* ------------------------------------------------------------------------------------------------------------- */
	
	/**
	 * @var $default The default JSON response pattern
	 */
	private $default = array('success' => FALSE, 'result' => array(), 'errors' => array(), 'message' => "");
	
	private $filter_request = array('success', 'result', 'request', 'response', 'message');
	
	/* ------------------------------------------------------------------------------------------------------------- */
	
    public function __construct()
    {
        parent::__construct();
        
        // Get the ajax request params and priorize POST datas
        foreach($_GET as $name => $value) $params[$name] = $this->input->get($name);
        foreach($_POST as $name => $value) $params[$name] = $this->input->get($name); 		
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
 
    function index( $request =NULL )
    {
    	// If invalid request then response that and exit the code
    	if($request == NULL && !in_array($request, $this->filter_request) && !method_exists($this, $request))
    	{
    		header('HTTP/1.1 400 Bad Request', true, 400);
    		exit('INVALID REQUEST');
    	}
    	else if(method_exists($this, $request) && !in_array($request, $this->filter_request))
    	{
    		$this->request($request);
    		$this->$request();
    	}
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    function request( $method )
    {
    	 
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    function success( $success =TRUE )
    {
    	$this->resonse['success'] = $success;
    	return $this;
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    function result( $data =array() )
    {
    	
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    function message( $message ="" )
    {
    	 
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    function response( $success =NULL, $results =array(), $message="" )
    {
    	
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
}

/* End of file: forum.php */
/* Location: ./modules/io_forum/controllers/forum.php */