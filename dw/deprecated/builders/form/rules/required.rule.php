<?php

class requiredFormRule extends dwForm_rule
{
	public static function getRuleId()
	{
		return 'required';
	}
	
	public static function validate($elt)
	{
		return !(request::is_set($elt -> name) && empty($_REQUEST[$elt -> name]));
	}

}


?>