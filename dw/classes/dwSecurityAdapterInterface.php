<?php 

namespace dw\classes;

interface dwSecurityAdapterInterface {
	
	public function prepare($config);
	public function control(dwHttpRequest $request, dwHttpResponse $response);
	
}

?>