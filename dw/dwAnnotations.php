<?php

namespace dw;

use dw\dwApplication;
use dw\helpers\dwFile;

dw_require('vendors/addendum/annotations');

/**
 * 
 * @author Clevertech
 *
 */
class dwAnnotations {
	
	protected static $_annotations = array();
	
	public static function load() {
		$annotationFiles = dwApplication::includeOnceDirectory(DW_BASE_DIR."annotations/");
		foreach($annotationFiles as $file) {
			dwAnnotations::$_annotations[] = dwFile::getAbsoluteName($file);
		}
	}
	
	/**
	 * 
	 */
	public static function process($app, $class) {
		
		$annotations = array();
		$reflection = new \ReflectionAnnotatedClass($class);
		
		foreach(dwAnnotations::$_annotations as $annotationName) {
		
			$annotationsMappingClass = $reflection -> getAnnotations($annotationName);
			$reflectionMethods = $reflection -> getMethods();
			
			foreach($reflectionMethods as $reflectionMethod) {
			
				$classMethod = "class";
				$fn = $reflectionMethod -> $classMethod."::".$reflectionMethod -> name;
				
	
				
				$fnAnnotation = "\\".$annotationName."::process";
				
				
				
				$annotationsMapping = $reflectionMethod -> getAllAnnotations($annotationName);
			
				foreach($annotationsMapping as $mapping) {
			
					if(count($annotationsMappingClass) > 0) {
			
						foreach($annotationsMappingClass as $mappingClass) {

							
							
							eval($fnAnnotation.'($app, $fn, $mappingClass, $mapping);');

						}
			
					} else {
						
						eval($fnAnnotation.'($app, $fn, null, $mapping);');
						
					}
				}
			}
		}
		
		
	}
	
	
}

?>