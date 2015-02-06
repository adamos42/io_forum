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
	 * @var $request array JSON request array
	 */
	private $request = array();
	
	/**
	 * @var $params array JSON request params array
	 */
	private $params = array();
	
	/**
	 * @var $response array JSON response array
	 */
	private $response = array();	
	
	/* ------------------------------------------------------------------------------------------------------------- */
	
	/**
	 * @var $default array The default JSON response pattern
	 */
	private $default = array('success' => FALSE, 'result' => array(), 'error' => array(), 'message' => "");

	/**
	 * @var $filter_request array The request method filter
	 */
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
 
    public function index( $method =NULL )
    {    	
    	// If invalid request then response that and exit the code
    	if($method == NULL && !in_array($method, $this->filter_request) && !method_exists($this, $request))
    	{
    		header('HTTP/1.1 400 Bad Request', true, 400);
    		exit('INVALID REQUEST');
    	}
    	else if(method_exists($this, $method) && !in_array($method, $this->filter_request))
    	{
    		$this->request($method);
    		$this->$method();
    	}
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */    
    /* ------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------- */
    
    public function forum_create()
    {
    	
    	
    	$this->response();
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------- */
    /* ------------------------------------------------------------------------------------------------------------- */
    
    private function request( $method )
    {
    	// Saving the method name
    	$this->request['method'] = $method;
    	
    	// Creating the response array
    	$this->response = $this->default;
    	 
    	// Gettint the request beginning time
    	if(isset($_SERVER['REQUEST_TIME_FLOAT'])) $this->request['timestamp'] = $_SERVER['REQUEST_TIME_FLOAT'];
    	else $this->request['timestamp'] = $_SERVER['REQUEST_TIME'];
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    private function success( $success =TRUE )
    {
    	$this->response['success'] = $success;
    	return $this;
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    private function result( $data =array() )
    {
    	$this->response['result'] = $data;
    	return $this;
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    private function error( $message ="" )
    {
    	$this->response['error'][] = $message;
    	$this->response['success'] = FALSE;
    	return $this;
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    private function message( $message ="" )
    {
    	$this->response['message'] = $message;
    	return $this;
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
    
    private function response( $success =NULL, $results =array(), $message="" )
    {
    	$this->response['timestamp'] = microtime(TRUE);
    	$this->response['ellapsed_time'] = $this->response['timestamp']-$this->request['timestamp'];
    	
    	header('Content-Type: application/json');
    	echo json_encode($this->response);
    }
    
    /* ------------------------------------------------------------------------------------------------------------- */
}

/* End of file: forum.php */
/* Location: ./modules/io_forum/controllers/forum.php */