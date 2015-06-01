<?php

namespace dw\classes;

use dw\classes\dwHttpRequest;
use dw\classes\dwHttpResponse;
use dw\classes\dwModel;

interface dwControllerInterface
{
	 public function startRequest(dwHttpRequest &$request, dwHttpResponse &$response, dwModel &$model);
	 public function processRequest(dwHttpRequest &$request, dwHttpResponse &$response, dwModel &$model);
	 public function endRequest(dwHttpRequest &$request, dwHttpResponse &$response, dwModel &$model);
}

?>