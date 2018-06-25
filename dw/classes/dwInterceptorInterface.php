<?php

namespace dw\classes;

/**
 * Interface for interceptors
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */
 
interface dwInterceptorInterface 
{
	public function init();
	public function prepareRequest(dwHttpRequest $request, dwHttpResponse $response, dwModel $model);
	public function processRequest(dwHttpRequest $request, dwHttpResponse $response, dwModel $model);
	public function terminateRequest(dwHttpRequest $request, dwHttpResponse $response, dwModel $model);
}