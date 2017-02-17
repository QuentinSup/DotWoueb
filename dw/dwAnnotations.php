<?php

namespace dw;

use dw\dwFramework as dw;
use dw\helpers\dwFile;

dw_require('vendors/addendum/annotations');

/**
 * 
 * @author Clevertech
 *
 */
class dwAnnotations {
	
	protected static $_annotations = array();
	
	public static function load($dir) {
		$annotationFiles = dw::includeOnceDirectory($dir);
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
	
			$fnAnnotationClass = "\\".$annotationName."::processClass";
			$fnAnnotationMethod = "\\".$annotationName."::processMethod";
			$fnAnnotationProperty = "\\".$annotationName."::processProperty";
			
			$annotationsClass = $reflection -> getAnnotations($annotationName);
			
			if($annotationsClass) {
				if(is_callable($fnAnnotationClass)) {
					eval($fnAnnotationClass.'($app, $reflection, $annotationClass);');
				}
			}
			
			$reflectionMethods = $reflection -> getMethods();
			$reflectionProperties = $reflection -> getProperties();

			if(is_callable($fnAnnotationProperty)) {
				foreach($reflectionProperties as $reflectionProperty) {
					
					$annotationsProperty = $reflectionProperty -> getAllAnnotations($annotationName);
					foreach($annotationsProperty as $annotationProperty) {
	
						if(count($annotationsClass) > 0) {
								
							foreach($annotationsClass as $annotationClass) {
								eval($fnAnnotationProperty.'($app, $reflection, $reflectionProperty, $annotationClass, $annotationProperty);');
							}
								
						} else {
							eval($fnAnnotationProperty.'($app, $reflection, $reflectionProperty, null, $annotationProperty);');
						}
						
					}
				}
			}
			
			if(is_callable($fnAnnotationMethod)) {
				foreach($reflectionMethods as $reflectionMethod) {
				
					$annotationsMethod = $reflectionMethod -> getAllAnnotations($annotationName);
				
					foreach($annotationsMethod as $annotationMethod) {
				
						if(count($annotationsClass) > 0) {
				
							foreach($annotationsClass as $annotationClass) {
								eval($fnAnnotationMethod.'($app, $reflection, $reflectionMethod, $annotationClass, $annotationMethod);');
							}
				
						} else {
							eval($fnAnnotationMethod.'($app, $reflection, $reflectionMethod, null, $annotationMethod);');
						}
					}
				}
			}
		}
		
		
	}
	
	
}

?>