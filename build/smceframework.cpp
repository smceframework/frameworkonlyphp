
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 

#include "php_smceframework.h"

zend_module_entry smceframework_module_entry = {
#if ZEND_MODULE_API_NO >= 20010901
  STANDARD_MODULE_HEADER,
#endif
  PHP_SMCEFRAMEWORK_EXTNAME,
  NULL,                   //!< Functions
	PHP_MINIT(smceframework),
    NULL,                  /* MSHUTDOWN */
    NULL,                  /* RINIT */
    NULL,                  /* RSHUTDOWN */
    NULL,                   // MINFO
#if ZEND_MODULE_API_NO >= 20010901
  PHP_SMCEFRAMEWORK_VERSION,
#endif
  STANDARD_MODULE_PROPERTIES
};

#ifdef COMPILE_DL_SMCEFRAMEWORK
extern "C" {
ZEND_GET_MODULE(smceframework)
}
#endif
