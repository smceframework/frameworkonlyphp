
struct smrouter_object {
  zend_object std;
  SmRouter *smrouter;
};

zend_class_entry *smrouter_ce;
zend_object_handlers smrouter_object_handlers;


zend_function_entry smrouter_methods[] = {
  
    PHP_ME(SmRouter , hello, NULL, ZEND_ACC_PUBLIC)
    {NULL, NULL, NULL}
};

zend_module_entry smceframework_module_entry = {
#if ZEND_MODULE_API_NO >= 20010901
  STANDARD_MODULE_HEADER,
#endif
  PHP_SMCEFRAMEWORK_EXTNAME,
  NULL,                   //!< Functions
  PHP_MINIT(smceframework),
  NULL,                   //!< MSHUTDOWN
  NULL,                   //!< RINIT
  NULL,                   //!< RSHUTDOWN
  NULL,                   //!< MINFO
#if ZEND_MODULE_API_NO >= 20010901
  PHP_SMCEFRAMEWORK_EXTNAME,
#endif
  STANDARD_MODULE_PROPERTIES
};

#ifdef COMPILE_DL_SMCEFRAMEWORK
ZEND_GET_MODULE(vehicles)
#endif


PHP_METHOD(SmRouter, hello)
{
	  SmRouter *smrouter = NULL;
	 
	 smrouter_object  *obj =(smrouter_object *) zend_object_store_get_object(
getThis() TSRMLS_CC);
      
      smrouter=obj->smrouter;
    RETURN_STRING("saa", 0);
   
}

