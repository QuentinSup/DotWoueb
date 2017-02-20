<?php

namespace dw;

use dw\dwFramework as dw;
use dw\classes\dwHttpRequest;
use dw\classes\dwHttpResponse;
use dw\classes\dwModel;
use dw\processors\dwTextResponse;
use dw\processors\dwJsonResponse;
use dw\classes\dwException;
use dw\enums\HttpStatus;

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
			
			if(!dwSecurityController::control($controllerClass, $controllerMethod, $request, $response)) {
				$response -> statusCode = HttpStatus::UNAUTHORIZED;
				$response -> end(); // end script
			}

			dwPlugins::forAllPluginsDo('prepareRequest', $request, $response, $model);
			if(dwInterceptors::forAllInterceptorsDo('prepareRequest', $request, $response, $model)) {

				if(class_exists($controllerClass))
				{
					if(!is_subclass_of($controllerClass,'dw\classes\dwControllerInterface'))
					{
						throw new dwException("Controler must inherit dw\classes\dwControllerInterface");
					}
				
					$controller = new $controllerClass();

					if($controller -> startRequest($request, $response, $model) !== false) {

						dwPlugins::forAllPluginsDo('processRequest', $request, $response, $model);
						if(dwInterceptors::forAllInterceptorsDo('processRequest', $request, $response, $model)) {
					
							$resp = $controller -> processRequest($request, $response, $model);
	
							if(!is_null($controllerMethod)) {
								$resp = $controller -> $controllerMethod($request, $response, $model);
							}
	
							if(is_string($resp)) {
								
								if(strpos($resp, 'redirect:') === 0) {
									$url = substr($resp, 9);
									header("Location: $url");
									die;
								}
								
								$ipos = strpos($resp, ":");
								if($ipos) {
									$callerName = substr($resp, 0, $ipos);
									$strContent = substr($resp, $ipos + 1);
									$processorClass = dw::App() -> getClassProcessor($callerName);
									if(!$processorClass) {
										throw new dwException("'$callerName' cannot be interpreted as a processor");
									}
									$resp = new $processorClass($strContent);
								} else {
									$resp = new dwTextResponse($resp);
								}
								
							} elseif(!$resp) {
								$resp = new dwTextResponse("");	
							} elseif(is_array($resp)) {
								if($response -> isJSONContent()) {
									$resp = new dwJsonResponse($resp);
								}
							}

							if(!is_subclass_of($resp, 'dw\classes\dwHttpResponseInterface')) {
								throw new dwException("The return value of controller must inherits `dw\classes\dwHttpResponseInterface");	
							}

							$response -> out($resp -> render($model -> toArray()));
				
						}
					}
					$controller -> endRequest($request, $response, $model);
				
				} else {
					$response -> statusCode = 404;
				}
			}
			
			dwPlugins::forAllPluginsDo('terminateRequest', $request, $response, $model);
			dwInterceptors::forAllInterceptorsDo('terminateRequest', $request, $response, $model);
	
		} catch(\Exception $e) {
			$response -> statusCode = 500;
			dwErrorController::exceptionHandler($e);
		}

		$response -> flush();
		
	}
}
?>
