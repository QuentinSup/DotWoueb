<?php 

namespace dw\classes;

interface dwSecurityAdapterInterface {
	
	public function digestConfig($xml);
	public function prepare();
	public function control(dwHttpRequest $request, dwHttpResponse $response);
	
}