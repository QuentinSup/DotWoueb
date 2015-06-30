<?php

namespace dw;

use dw\classes\dwController;
use dw\classes\dwHttpRequest;
use dw\classes\dwHttpResponse;
use dw\classes\dwModel;
use dw\classes\dwTemplate;
use dw\classes\dwObject;
use dw\views\dwTemplateView;
use dw\views\dwTextView;
use dw\accessors\ary;
use dw\classes\dwException;
use dw\dwFramework as dw;

/**
 * Execute controllers
 */
class dwFrontController {
	
	private static $_hinstance;
	
	public static function &singleton() {
		if(!isset(self::$_hinstance))
		{
			$fc = new dwFrontController();
			self::$_hinstance = $fc;	
		}
		return self::$_hinstance;
	}
	
	public function run(dwHttpRequest $request) {

		$route = $request -> getRoute();
		$response = new dwHttpResponse();
		$model = new dwModel(array("properties" => dw::App() -> getProperties()));
		
		$response -> start();
				
		try {
			
			$callback = null;
			
			if($route) {
				$callback = $route -> getRouteFunction();
				if(!is_null($route -> getProduces())) {
					$response -> contentType = $route -> getProduces();
				}
			}
			
			$controllerClass = null;
			$controllerMethod = null;
			
			if(is_string($callback)) {
			
				$ipos_ = strpos($callback, "::");

				if($ipos_ > 0) {
					$controllerClass = substr($callback, 0, $ipos_);
					$controllerMethod = substr($callback, $ipos_ + 2);
				} else {
					$controllerClass = $callback;
				}
			
			} elseif(is_array($callback)) {
				$controllerClass = $callback[0];
				$controllerMethod = $callback[1];	
			}
			
			if(class_exists($controllerClass))
			{
				if(!is_subclass_of($controllerClass,'dw\classes\dwControllerInterface'))
				{
					throw new dwException("Les controleurs doivent hériter de dwControllerInterface");		
				}

				dwPlugins::forAllPluginsDo('prepareRequest', $request);
				if(dwListeners::forAllListenersDo('prepareRequest', $request)) {

					$controller = new $controllerClass();

					$controller -> startRequest($request, $response, $model);

					dwPlugins::forAllPluginsDo('processRequest', $request);
					if(dwListeners::forAllListenersDo('processRequest', $request)) {
				
						$view = $controller -> processRequest($request, $response, $model);

						if(!is_null($controllerMethod)) {
							$view = $controller -> $controllerMethod($request, $response, $model);
						}

						if(is_string($view)) {
							if(strpos($view, 'redirect:') === 0) {
								$url = substr($view, 9);
								header("Location: $url");
								die;
							}
							
							if(strpos($view, 'view:') === 0) {
								$view = new dwTemplateView(substr($view, 5));
								$modelAttributes = $model -> toArray();
								$view -> setModel($modelAttributes);	
							} else {
								$view = new dwTextView($view);
							}

						} elseif(!$view) {
							$view = new dwTextView("");	
						}

						$response -> setContent($view -> render());
				
						if(!is_subclass_of($view, 'dw\classes\dwViewInterface')) {
							throw new dwException("Les retours doivent hériter de dwViewInterface");	
						}
				
						$controller -> endRequest($request, $response, $model);
					}
					
				}
				
				dwPlugins::forAllPluginsDo('terminateRequest', $request);
				dwListeners::forAllListenersDo('terminateRequest', $request);

			} 
			else 
			{
				$response -> statusCode = 404;
			}
		
		} catch(\Exception $e) {
						
			$response -> statusCode = 500;
			dwErrorController::exceptionHandler($e);
		}
		
		$response -> flush();
		
	}
}
?>