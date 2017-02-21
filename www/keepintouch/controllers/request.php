<?php

namespace keepintouch;

use dw\dwFramework as dw;
use dw\classes\dwHttpRequest;
use dw\classes\dwHttpResponse;
use dw\classes\dwModel;
use dw\classes\http\dwHttpSocket;
use dw\enums\HttpStatus;
use dw\classes\controllers\dwBasicController;

/**
 * @Mapping(value = '/request')
 */
class request extends dwBasicController {

	/**
	 * @Mapping(method = "post")
	 */
	public function push(dwHttpRequest &$request, dwHttpResponse &$response, dwModel &$model)
	{
		$json = $request -> getRequestBody();
		
		$r = new dwHttpSocket();
		$resp = $r -> send('POST', 'http://localhost:8080/myapi/api/QuentinSup/keepintouch/request', $json, array("Content-Type" => "application/json; charset=utf8"));
		
		$response -> statusCode = $resp -> status_code;
		return $resp -> body;
		
	}

}

?>