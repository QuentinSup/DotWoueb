<?php

namespace dw;

use dw\dwFramework as dw;
use dw\dwInterceptors;
use dw\dwPlugins;
use dw\dwAnnotations;
use dw\classes\dwException;
use dw\classes\dwXMLConfig;
use dw\accessors\ary;
use dw\classes\dwRouteMap;
use dw\classes\dwLogger;
use dw\classes\dwHttpRequest;

define('E_APP_LOAD', "001");

/**
 * Manage application
 */
class dwApplication extends dwXMLConfig
{
	protected $_plugins = array();
	protected $_listeners = array();
	protected $_runmode = 0;
	protected $_lang = null;
	protected $_routemap = null;
	protected $_connectors = array();
	protected $_properties = array();
	protected $_namespace = "";
	protected $_controllers = array();
	protected $_views = array();
	
	// Logger
	private static function logger() {
		static $logger = null;
		if(is_null($logger)) {
			$logger = dwLogger::getLogger(__CLASS__);
		}
		return $logger;
	}

	/**
	 * Constructeur
	 */
	public function __construct($namespace = "") {
		$this -> _namespace = $namespace;
		$this -> _routemap = new dwRouteMap();
		//$this -> logger = \Logger::getLogger("main");
	}
	
	/**
	 * Retourne la route map
	 */
	public function getRouteMap() {
		return $this -> _routemap;
	}

	/**
	 * getPlugins()
	 * @return array La liste des plugins de l'application
	 */
	public function getPlugins()	{ return $this -> _plugins; }
	/**
	 * getListeners()
	 * @return array La liste des listeners de l'application
	 */
	public function getListeners()	{ return $this -> _listeners; }
	/**
	 * getRunMode()
	 * Renvoi l'état d'execution (0:Debug; 1:Release)
	 * @return int
	 */
	public function getRunMode()	{ return $this -> _runmode; }
	
	/**
	 * Retourne la langue de l'application par défaut
	 * @return La langue
	 */
	public function getLang()		{ return $this -> _lang; }
	
	/**
	 * Return the namespace specified for the app
	 */
	public function getNamespace() {
		return $this -> _namespace."\\";
	}
	
	/**
	 * Specify the namespace specified for the app
	 */
	public function setNamespace($ns) {
		$this -> _namespace = $ns;
	}
	
	/**
	 * Load a connector from its xml configuration
	 * @param $xmlConnectorConfig The xml configuration extracted from the main Xml configuration
	 */
	protected function loadConnectorConfig($xmlConnectorConfig) {
		$connector = dwConnectors::factory((string)$xmlConnectorConfig -> type);
		if($connector) {
			$connector -> digestConfig($xmlConnectorConfig);
			$this -> _connectors[(string)$xmlConnectorConfig -> name] = $connector;
		}
	}
	
	/**
	 * Load a listener from its xml configuration
	 * @param $xmlListenerConfig The xml configuration extracted from the main Xml configuration
	 */
	protected function loadInterceptorConfig($xmlListenerConfig) {
		$listener = dwInterceptors::load((string)$xmlListenerConfig -> name);
		$this -> _listeners[(string)$xmlListenerConfig -> name] = $listener;
	}
	
	/**
	 * Load a plugin from its xml configuration
	 * @param $xmlPluginConfig The xml configuration extracted from the main Xml configuration
	 */
	protected function loadPluginConfig($xmlPluginConfig) {
		$oplug = dwPlugins::load((string)$xmlPluginConfig -> name);
		$this -> _plugins[(string)$xmlPluginConfig -> name] = $oplug;
	}
	
	/**
	 * Load a property from its xml configuration
	 * @param $xmlProperty The xml configuration extracted from the main Xml configuration
	 */
	protected function loadPropertyConfig($xmlProperty) {
		$this -> _properties[(string)$xmlProperty -> name] = (string)$xmlProperty -> cdata;
	}
	
	/**
	 * loadConfig()
	 * Load configuration from XML file
	 * @author QuentinSup
	 * @param string $scurpath Path to the config XML file
	 * @param string $sencoding encoding (default is 'ISO-8859-1')
	 * @param string $sxml the config filename (default is 'config.xml')
	 */
	public function loadConfig($scurpath = './', $sxml = 'config.xml', $sencoding = 'ISO-8859-1')
	{
		try
		{
			$xml = parent::loadConfig($scurpath, $sxml, $sencoding);
			
			// Main config
			$this -> _runmode 	= (int)$xml -> config -> application -> run;
			if(isset($xml -> config -> application -> lang)) {
				$this -> _lang 		= (string)$xml -> config -> application -> lang;
			}
			
			if(isset($xml -> config -> application -> ns)) {
				$this -> _namespace = (string)$xml -> config -> application -> ns;
			}

			// connectors
			if(isset($xml -> config -> connectors) && isset($xml -> config -> connectors -> connector)) {
				if(is_object($xml -> config -> connectors -> connector)) {
					$this -> loadConnectorConfig($xml -> config -> connectors -> connector);
				} else {
					foreach($xml -> config -> connectors -> connector as $connectorXmlConfig) {
						$this -> loadConnectorConfig($connectorXmlConfig);
					}	
				}
			}

			// listeners
			if(isset($xml -> config -> interceptors) && isset($xml -> config -> interceptors -> interceptor))
			{
				if(is_object($xml -> config -> interceptors -> interceptor)) {
					$this -> loadListenerConfig($xml -> config -> listeners -> listener);
				} else {
					foreach($xml -> config -> interceptors -> interceptor as $xmlListenerConfig)
					{
						$this -> loadInterceptorConfig($xmlListenerConfig);
					}
				}
			}
			
			// plugins
			if(isset($xml -> plugins) && isset($xml -> plugins -> plugin))
			{
				if(is_object($xml -> plugins -> plugin)) {
					$this -> loadPluginConfig($xml -> plugins -> plugin);
				} else {
					foreach($xml -> plugins -> plugin as $xmlPluginConfig)
					{
						$this -> loadPluginConfig($xmlPluginConfig);
					}
				}
			}
			
			if(isset($xml -> config) && isset($xml -> config -> properties) && isset($xml -> config -> properties -> property))
			{
				if(is_object($xml -> config -> properties -> property)) {
					$this -> loadPropertyConfig($xml -> config -> properties -> property);	
				} else {
					foreach($xml -> config -> properties -> property as $xmlProperty)
					{
						$this -> loadPropertyConfig($xmlProperty);	
					}
				}
			}
			
		} catch(\Exception $e) {
			throw new dwException(E_APP_LOAD);	
		}
	}
	
	/**
	 * Return a connector from its name
	 * @param $name the specified name
	 * @return the connector instance, or null if it doesn't exists
	 */
	public function getConnector($name) {
		$connector = ary::get($this -> _connectors, $name);
		if(!is_null($connector)) {
			return $connector -> getInstance();
		}
		return null;
	}
	
	/**
	 * Return the value of the property specified
	 * @param $name The name of the property (case sensitive)
	 * @param $defaultValue The default value if the property doesn't exist
	 * @return the value, or null
	 */
	public function getProperty($name, $defaultValue = null) {
		return ary::get($this -> _properties, $name, $defaultValue);
	}
	
	/**
	 * Return the list of properties
	 * @return the full list
	 */
	public function getProperties() {
		return $this -> _properties;
	}
	
	/**
	 * toArray()
	 * @author Quentin Supernant
	 * @return array Tableau contenant la liste des parametres de l'objet application
	 */
	public function toArray()
	{
		$ary = array(
				"name" 		  => $this -> _name, 
				"author" 	  => $this -> _author, 
				"version" 	  => $this -> _version,
				"description" => $this -> _description,
				"run"		  => $this -> _runmode,
				"connectors"  => $this -> _connectors,
				"listeners "  => $this -> _listeners,
				"vars" 		  => $this -> _vars);
		
		foreach($this -> _plugins as $name => $plugin) {				
			$ary["plugins"][$name] = dwXMLConfig::getAttributes($plugin); 	
		}
		
		return $ary;	
	}
	
	/**
	 * 
	 */
	public function prepare() {
		
		if(self::logger() -> isInfoEnabled()) {
			self::logger() -> info("Initialize app");
		}
		
		// Initialize connectors
		
		if(self::logger() -> isInfoEnabled()) {
			self::logger() -> info("Initialize connectors");
		}
		
		foreach($this -> _connectors as $connector) {
			$connector -> prepare();
		}

		$this -> loadControllers();
		
	}
		
	/**
	 * Take a look into declared classes to identify Controllers and set mapping
	 */
	public function loadControllers() {

		// Initialize controllers and mapping
		
		if(self::logger() -> isInfoEnabled()) {
			self::logger() -> info("Initialize controllers");
		}
		
		// Load from app directory
		dw::includeOnceDirectory(APP_CONTROLLERS_DIR);
		
		if(self::logger() -> isInfoEnabled()) {
			self::logger() -> info("Load controllers from declared classes and set mapping");
		}
		
		$classes = get_declared_classes();
		
		foreach($classes as $class) {

			// Controller
			if(is_subclass_of($class, 'dw\classes\dwControllerInterface')) {

				if(in_array($class, $this -> _controllers)) {
					
					if(self::logger() -> isWarnEnabled()) {
						self::logger() -> warn("Controller $class already exists");
					}
					
					continue;
				}
			
				if(self::logger() -> isDebugEnabled()) {
					self::logger() -> debug("Found new controller $class");
				}
				
				$this -> _controllers[] = $class;
				
				// Process annotations
				dwAnnotations::process($this, $class);
				
			}
			
			// Listener
			if(is_subclass_of($class, 'dw\classes\dwListenerInterface')) {

				// Process annotations
				dwAnnotations::process($this, $class);
			}
						
			// View
			if(is_subclass_of($class, 'dw\classes\dwViewInterface')) {

				$callerName = $class::getCallerName();
				if($callerName) {
					
					if(self::logger() -> isDebugEnabled()) {
						self::logger() -> debug("Found view interface $callerName");
					}
					
					$this -> _views[$callerName] = $class;
				}
			}
			
		}

	}
	
	public function getClassView($callerName) {
		return ary::get($this -> _views, $callerName);
	}

	/**
	 * Dispatch user to the specified route
	 * @param $uri to dispatch (optional)
	 * @param $method of the request (optional)
	 * @param $consumes the contentType to consume (optional)
	 */
	public function dispatch($uri = null, $method = null, $consumes = null) {

		$request = new dwHttpRequest($uri, $method, $consumes);
		
		$pathVars = array();

		if(self::logger() -> isInfoEnabled()) {
			self::logger() -> info("Dispatch user from uri: ".$request -> getRequestUri().", method: ".$request -> getMethod().", consumes: ".$request -> getContentType());
		}

		$route = $this -> getRouteMap() -> searchRoute($request -> getRequestUri(), $request -> getMethod(), $request -> getContentType(), $pathVars);
	
		$request -> setPathVars($pathVars);
		$request -> setRoute($route);
		
		dw::run($request);

	}
	
}

?>
