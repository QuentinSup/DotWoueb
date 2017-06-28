<?php

namespace dw\classes;

/**
 * Autoloader
 */
class dwAutoLoader {
	
	// List of namespaces and paths to map for
	protected $_namespacesMapping = [];
	
	// Logger
	private static function logger() {
		static $logger = null;
		if(is_null($logger)) {
			$logger = dwLogger::getLogger(__CLASS__);
		}
		return $logger;
	}
	
	/**
	 * Constructor
	 * @param $initMapping Initial namespaces mapping (optional)
	 */
	public function __construct($initMapping = array()) {
		$this -> addNamespaceRoutes($initMapping);
		spl_autoload_register(array($this, 'loader'));
	}
	
	/**
	 * Add a list of namespaces routes
	 * @param $ary Associative list with ns => path
	 */
	public function addNamespaceRoutes($ary) {
		foreach(array_keys($ary) as $ns) {
			$this -> addNamespaceRoute($ns, $ary[$ns]);	
		}
	}
	
	/**
	 * Add a namespace route
	 * @param $ns The namespace
	 * @param $path The path
	 */
	public function addNamespaceRoute($ns, $path) {
		
		$this -> _namespacesMapping[] = array("ns" => $ns, "path" => $path);
		// Sort list
		usort($this -> _namespacesMapping, array($this, "__compareNamespaceRoute"));
	}
	
	/**
	 * Function used to sort routes
	 * Bring the longest namespace to the top
	 */
	protected function __compareNamespaceRoute($route1, $route2) {
		return strlen($route1['ns']) < strlen($route2['ns']);
	}
	
	/**
	 * Loader callback
	 * @param $className The class name
	 */
	protected function loader($className) {
				
		foreach($this -> _namespacesMapping as $route) {
			/*
			if(self::logger() -> isTraceEnabled()) {
				self::logger() -> trace("Look for '$className' with namespace route '".$route['ns']."'");
			}
			*/
			
			if(strpos($className, $route['ns']."\\") === 0) {
				$classPath = str_ireplace("\\", "/", substr($className, strlen($route['ns'])));
				$classPath .= stripos($classPath, ".php") == strlen($classPath) - strlen(".php")?"":".php";
								
				require_once($route['path'].$classPath);

				if(self::logger() -> isDebugEnabled()) {
					self::logger() -> debug("Resolve class '$className' : ".$route['path']."$classPath");
				}
				
				return;
			}
		}		
		
		if(self::logger() -> isTraceEnabled()) {
			self::logger() -> trace("Unable to resolve class '$className'");
		}
		
	}
	
}

?>