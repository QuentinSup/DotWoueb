<?php

namespace dw;

use dw\dwFramework as dw;
use dw\dwListeners;
use dw\dwPlugins;
use dw\classes\dwXMLConfig;
use dw\helpers\dwString;
use dw\helpers\dwFile;
use dw\accessors\server;
use dw\accessors\ary;
use dw\classes\dwRouteMap;
use dw\classes\dwLogger;
use dw\classes\dwHttpRequest;

define('E_APP_LOAD', "001");

dw_require('vendors/addendum/annotations');
dw_require('annotations/Mapping');

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
	public function __construct() {
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
	 * Renvoi l'鴡t d'ex飵tion (0:Debug; 1:Release)
	 * @return int
	 */
	public function getRunMode()	{ return $this -> _runmode; }
	
	/**
	 * Retourne la langue de l'application par d馡ut
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
	protected function loadListenerConfig($xmlListenerConfig) {
		$listener = dwListeners::load((string)$xmlListenerConfig -> name);
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
	 * Charge les param贲es de l'application contenus dans un fichier XML
	 * @author Quentin Supernant
	 * @param string $scurpath Chemin ou se trouve le fichier XML
	 * @param string $sencoding Le type d'encodate du fichier XML (par défaut 'ISO-8859-1')
	 * @param string $sxml Le nom du fichier XML (par défaut 'config.xml')
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
			if(isset($xml -> config -> listeners) && isset($xml -> config -> listeners -> listener))
			{
				if(is_object($xml -> config -> listeners -> listener)) {
					$this -> loadListenerConfig($xml -> config -> listeners -> listener);
				} else {
					foreach($xml -> config -> listeners -> listener as $xmlListenerConfig)
					{
						$this -> loadListenerConfig($xmlListenerConfig);
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
		
		// Initialize controllers and mapping
		
		if(self::logger() -> isInfoEnabled()) {
			self::logger() -> info("Initialize controllers");
		}
		
		self::includeOnceDirectory(DW_CONTROLLERS_DIR);
		
		$this -> loadControllersMapping();
		
	}
	
	/**
	 * Try to include all files from a directory
	 * $dir The directory to scan
	 */
	public static function includeOnceDirectory($dir) {
		$list = dwFile::ls($dir);
		foreach($list as $file) {

			if(!is_dir($file)) {
							
				include_once($file);
			
			}
		}	
	}
	
	/**
	 * Take a look into declared classes to identify Controllers and set mapping
	 */
	public function loadControllersMapping() {

		if(self::logger() -> isInfoEnabled()) {
			self::logger() -> info("Load controllers from declared classes and set mapping");
		}
		
		$classes = get_declared_classes();
		foreach($classes as $class) {
			
			if(!is_subclass_of($class, 'dw\classes\dwControllerInterface')) {
				continue;
			}
			
			if(in_array($class, $this -> _controllers)) {
				continue;
			}
			
			if(self::logger() -> isDebugEnabled()) {
				self::logger() -> debug("Found new controller $class");
			}
			
			$this -> _controllers[] = $class;
			
			$annotations = array();
			$reflection = new \ReflectionAnnotatedClass($class);

			$annotationsMappingClass = $reflection -> getAnnotations("Mapping");
			$reflectionMethods = $reflection -> getMethods();

			foreach($reflectionMethods as $reflectionMethod) {

				$class = "class";
				$fn = $reflectionMethod -> $class."::".$reflectionMethod -> name;

				$annotationsMapping = $reflectionMethod -> getAllAnnotations("Mapping");	

				foreach($annotationsMapping as $mapping) {

					if(count($annotationsMappingClass) > 0) {

						foreach($annotationsMappingClass as $mappingClass) {

							$value = "";
							if($mappingClass -> getValue()) {
								$value = $mappingClass -> getValue();
								if(substr($value, strlen($value) - 1) != "/") {
									$value .= "/";
								}
							}

							$uri = $value.$mapping -> getValue();
							$method = $mapping -> getMethod()?$mapping -> getMethod():$mappingClass -> getMethod();
							$consumes = $mapping -> getConsumes()?$mapping -> getConsumes():$mappingClass -> getConsumes();
							$produces = $mapping -> getProduces()?$mapping -> getProduces():$mappingClass -> getProduces();

							$this -> getRouteMap() -> addRoute(
								$uri, 
								$fn, 
								$method, 
								$consumes, 
								$produces);		
						}

					} else {

						$this -> getRouteMap() -> addRoute(
							$mapping -> getValue(), 
							$fn, 
							$mapping -> getMethod(), 
							$mapping -> getConsumes(), 
							$mapping -> getProduces());	

					}
				}
			}
		}

	}
	
	/**
	 * Dispatch user to the specified route
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