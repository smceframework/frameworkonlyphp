<?php

namespace Smce\Core;

use Smce\Base\SmBase;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\ClassLoader;

class SmDoctrine
{
	
	public $entityManager;
	
	public function __construct()
	{
		
		if(isset(SmBase::$config["components"]["Doctrine"])){
			$paths = array(BASE_PATH."/model");
			$isDevMode = false;
			
			// the connection configuration
			$dbParams = SmBase::$config["components"]["Doctrine"];
			
			$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
			$this->entityManager=EntityManager::create($dbParams, $config);
			
		}
	}
	
}