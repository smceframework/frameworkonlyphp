
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
// Core
#include "../ext/Core/smce.cpp"

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

PHP_MINIT_FUNCTION(smceframework)
{
	
  zend_class_entry ce;
  
  INIT_NS_CLASS_ENTRY(ce, "Smce\\Ext", "SmUrlRouter", smurlrouter_methods);
  smurlrouter_ce = zend_register_internal_class(&ce TSRMLS_CC);
  smurlrouter_ce->create_object = smurlrouter_create_handler;
  memcpy(&smurlrouter_object_handlers, zend_get_std_object_handlers(),
      sizeof(zend_object_handlers));
  smurlrouter_object_handlers.clone_obj = NULL;
  
 INIT_NS_CLASS_ENTRY(ce,"Smce\\Ext", "Deneme", deneme_methods);
  deneme_ce = zend_register_internal_class(&ce TSRMLS_CC);
  deneme_ce->create_object = deneme_create_handler;
  memcpy(&deneme_object_handlers, zend_get_std_object_handlers(),
      sizeof(zend_object_handlers));
  deneme_object_handlers.clone_obj = NULL;
  
  return SUCCESS;
  
}


