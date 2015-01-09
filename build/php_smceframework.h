
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
#ifndef SMCE_BASE_SMCE_H
#define SMCE_BASE_SMCE_H 

 
#include <cstring>
#include <iostream>
#include <vector>
#include <sstream>

using namespace std;


#define PHP_SMCEFRAMEWORK_VERSION "0.0.1"
#define PHP_SMCEFRAMEWORK_EXTNAME "Smce Framework (PHP/C++)"

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif


extern "C" {	
	#include "php.h"
	#include "php_ini.h"
	#include "php_variables.h"
	#include "ext/standard/php_string.h"
	#include "ext/standard/url.h"
}

#ifdef ZTS
#include "TSRM.h"
#endif



PHP_MINIT_FUNCTION(smceframework);



extern zend_module_entry smframework_module_entry;
#define phpext_smceframework_ptr &smceframework_module_entry;

#endif

