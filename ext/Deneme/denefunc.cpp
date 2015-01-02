
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 


PHP_METHOD(Deneme, hello2);
 
struct deneme_object {
  zend_object std;
  Deneme *deneme;
};

zend_class_entry *deneme_ce;
zend_object_handlers deneme_object_handlers;


zend_function_entry deneme_methods[] = {
  
	PHP_ME(Deneme , hello2, NULL, ZEND_ACC_PUBLIC)
	{NULL, NULL, NULL}
};




void deneme_free_storage(void *object TSRMLS_DC)
{
  deneme_object *obj = (deneme_object*) object;
  delete obj->deneme;

  zend_hash_destroy(obj->std.properties);
  FREE_HASHTABLE(obj->std.properties);

  efree(obj);
}

zend_object_value deneme_create_handler(zend_class_entry *type TSRMLS_DC)
{
 
  zend_object_value retval;

  deneme_object *obj = (deneme_object*)emalloc(sizeof(deneme_object));
  memset(obj, 0, sizeof(deneme_object));
  obj->std.ce = type;

  ALLOC_HASHTABLE(obj->std.properties);
  zend_hash_init(obj->std.properties, 0, NULL, ZVAL_PTR_DTOR, 0);
  // Eklenen
	#if PHP_VERSION_ID < 50399
	
	zval *tmp;
	zend_hash_copy(obj->std.properties, &type->default_properties,                                                                                                                                                    (copy_ctor_func_t) zval_add_ref, (void *)&tmp, sizeof(zval *));

	#else
		object_properties_init(&(obj->std), type);
	#endif

  retval.handle = zend_objects_store_put(obj, NULL, deneme_free_storage,
	  NULL TSRMLS_CC);
  retval.handlers = &deneme_object_handlers;

  return retval;
}


PHP_METHOD(Deneme, hello2)
{
	 Deneme *dmr = NULL;
	 
	 deneme_object  *obj =(deneme_object *) zend_object_store_get_object(
getThis() TSRMLS_CC);
	  
	  dmr=obj->deneme;
	
	char *str;
	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &str) == FAILURE) {
		RETURN_NULL();
	}
	str=dmr->hello2(str);
  

	RETURN_STRING(str, false);
	
}



