<?php

namespace dw\classes;

use dw\classes\dwRoute;

class dwRouteMap {
	
	protected $_routes = array();
	
	// Logger
	private static function logger() {
		static $logger = null;
		if(is_null($logger)) {
			$logger = dwLogger::getLogger(__CLASS__);
		}
		return $logger;
	}
	
	public function addRoute($uri, $callback, $method = null, $consumes = null, $produces = null) {

		if(self::logger() -> isDebugEnabled()) {
			self::logger() -> debug("Ajout d'une route uri: '$uri' method: '$method' consumes: '$consumes' produces: '$produces'");
		}
		
		$route = new dwRoute($uri, $method, $consumes, $produces);
		$route -> setRouteFunction($callback);

		$this -> _routes[] = $route;
		usort($this -> _routes, array($this, "__compareRoutes"));
		
		return $route;

	}
	
	public function getRoutes() {
		return $this -> _routes;
	}
	
	protected function __compareRoutes($route1, $route2) {
		return $route1 -> getScore() < $route2 -> getScore();
	}
	
	/**
	 * Search the route
	 * @param $uri The uri to match
	 * @param $method The method to match
	 * @param $consumes The contentType to match
	 */
	public function searchRoute($uri = null, $method = null, $consumes = null, &$pathVars = array()) {

		foreach($this -> _routes as &$route) {
						
			if($route -> isRouteMatch($uri, $method, $consumes, $pathVars)) {
				return $route;
			}

		}
		
		return null;
		
	}
	


}


?>