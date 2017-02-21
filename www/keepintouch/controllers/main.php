<?php

namespace keepintouch;

use dw\dwFramework as dw;
use dw\classes\dwHttpRequest;
use dw\classes\dwHttpResponse;
use dw\classes\dwModel;
use dw\classes\controllers\dwBasicController;

/**
 * @Mapping(value = '/')
 */
class main extends dwBasicController {

	/**
	 * @Mapping(method = "get")
	 */
	public function root(dwHttpRequest &$request, dwHttpResponse &$response, dwModel &$model) 
	{				
		$model -> title = "Keep In Touch";
		$model -> webapp = "./";
		$model -> pageId = "main";
		$model -> version = "1.0.0";
		$model -> host = $request -> getBaseUri();
		
		
		return 'view:./views/index.html';
	}
	
}

?>