
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
	PHP_MSHUTDOWN(smceframework),
	PHP_RINIT(smceframework),
	PHP_RSHUTDOWN(smceframework),
  NULL,                   //!< MINFO
#if ZEND_MODULE_API_NO >= 20010901
  PHP_SMCEFRAMEWORK_VERSION,
#endif
  STANDARD_MODULE_PROPERTIES
};


#ifdef COMPILE_DL_SMCEFRAMEWORK
ZEND_GET_MODULE(smceframework)
#endif


PHP_MINIT_FUNCTION(smceframework)
{
	
  zend_class_entry _ce_smrouter;
  zend_class_entry _ce_deneme;
  
  INIT_NS_CLASS_ENTRY(_ce_smrouter, "Smce/Ext", "SmRouter", smrouter_methods);
  smrouter_ce = zend_register_internal_class(&_ce_smrouter TSRMLS_CC);
  smrouter_ce->create_object = smrouter_create_handler;
  memcpy(&smrouter_object_handlers, zend_get_std_object_handlers(),
      sizeof(zend_object_handlers));
  smrouter_object_handlers.clone_obj = NULL;
  
 INIT_NS_CLASS_ENTRY(_ce_deneme,"Smce/Ext", "Deneme", deneme_methods);
  deneme_ce = zend_register_internal_class(&_ce_deneme TSRMLS_CC);
  deneme_ce->create_object = deneme_create_handler;
  memcpy(&deneme_object_handlers, zend_get_std_object_handlers(),
      sizeof(zend_object_handlers));
  deneme_object_handlers.clone_obj = NULL;
  
  return SUCCESS;
  
}


PHP_MSHUTDOWN_FUNCTION(smceframework){
	return SUCCESS;
}

PHP_RINIT_FUNCTION(smceframework){
	#if SMCEFRAMEWORK_EXPERIMENTAL_CALL
		return smceframework_free_fcall_cache(TSRMLS_C);
	#else
		return SUCCESS;
	#endif
}


PHP_RSHUTDOWN_FUNCTION(smceframework){
	#if SMCEFRAMEWORK_EXPERIMENTAL_CALL
		return smceframework_free_fcall_cache(TSRMLS_C);
	#else
		return SUCCESS;
	#endif
}

