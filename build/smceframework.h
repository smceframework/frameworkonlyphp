
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
#ifndef SMCE_BASE_SMCE_H
#define SMCE_BASE_SMCE_H 
 
#define PHP_SMCEFRAMEWORK_VERSION "0.0.1"
#define PHP_SMCEFRAMEWORK_EXTNAME "Smce Framework (PHP/C++)"

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif


extern "C" {
#include "php.h"
#include <ext/standard/php_string.h>
}


#ifdef ZTS
#include "TSRM.h"
#endif



PHP_MINIT_FUNCTION(smceframework);
PHP_MSHUTDOWN_FUNCTION(smceframework);
PHP_RINIT_FUNCTION(smceframework);
PHP_RSHUTDOWN_FUNCTION(smceframework);



extern zend_module_entry smframework_module_entry;
#define phpext_smceframework_ptr &smceframework_module_entry;

#endif

