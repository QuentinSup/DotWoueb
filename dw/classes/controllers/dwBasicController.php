<?php

namespace dw\classes\controllers;

use dw\classes\dwControllerInterface;
use dw\classes\dwHttpResponse;
use dw\classes\dwHttpRequest;
use dw\classes\dwModel;
use dw\accessors\ary;

abstract class dwBasicController implements dwControllerInterface
{
	public function startRequest(dwHttpRequest &$request, dwHttpResponse &$response, dwModel &$model) {}
	public function endRequest(dwHttpRequest &$request, dwHttpResponse &$response, dwModel &$model) {}
	public function processRequest(dwHttpRequest &$request, dwHttpResponse &$response, dwModel &$model) {}
}

?>