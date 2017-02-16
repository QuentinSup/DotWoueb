<?php

namespace dw;

use dw\classes\dwHttpRequest;
use dw\classes\dwHttpResponse;
use dw\classes\dwModel;
use dw\views\dwTextView;
use dw\views\dwJsonView;
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

			dwPlugins::forAllPluginsDo('prepareRequest', $request, $response, $model);
			if(dwListeners::forAllListenersDo('prepareRequest', $request, $response, $model)) {

				if(class_exists($controllerClass))
				{
					if(!is_subclass_of($controllerClass,'dw\classes\dwControllerInterface'))
					{
						throw new dwException("Les controleurs doivent hériter de dwControllerInterface");
					}
				
					$controller = new $controllerClass();

					if($controller -> startRequest($request, $response, $model) !== false) {

						dwPlugins::forAllPluginsDo('processRequest', $request, $response, $model);
						if(dwListeners::forAllListenersDo('processRequest', $request, $response, $model)) {
					
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
								
								$ipos = strpos($view, ":");
								if($ipos) {
									$callerName = substr($view, 0, $ipos);
									$viewContent = substr($view, $ipos + 1);
									$viewClass = dw::App() -> getClassView($callerName);
									if(!$viewClass) {
										throw new dwException("'$callerName' cannot be interpreted as a view");
									}
									$view = new $viewClass($viewContent);
								} else {
									$view = new dwTextView($view);
								}
								
							} elseif(!$view) {
								$view = new dwTextView("");	
							} elseif(is_array($view)) {
								if($response -> isJSONContent()) {
									$view = new dwJsonView($view);
								}
							}

							if(!is_subclass_of($view, 'dw\classes\dwViewInterface')) {
								throw new dwException("The return value of controller must inherits dwViewInterface");	
							}
							
							$response -> setContent($view -> render($model -> toArray()));
				
						}
					}
					$controller -> endRequest($request, $response, $model);
				
				} else {
					$response -> statusCode = 404;
				}
			}
			
			dwPlugins::forAllPluginsDo('terminateRequest', $request, $response, $model);
			dwListeners::forAllListenersDo('terminateRequest', $request, $response, $model);
	
		} catch(\Exception $e) {
			$response -> statusCode = 500;
			dwErrorController::exceptionHandler($e);
		}

		$response -> flush();
		
	}
}
?>
