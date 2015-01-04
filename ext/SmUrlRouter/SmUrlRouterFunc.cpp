
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 

PHP_METHOD(SmUrlRouter, __construct);
PHP_METHOD(SmUrlRouter, setRequest);
PHP_METHOD(SmUrlRouter, setRouter);
PHP_METHOD(SmUrlRouter, setRoute);
PHP_METHOD(SmUrlRouter, run);
/*
PHP_METHOD(SmUrlRouter, createUrl);
PHP_METHOD(SmUrlRouter, redirect);
* */
 
zend_class_entry *smurlrouter_ce;
zend_object_handlers smurlrouter_object_handlers;

struct smurlrouter_object {
  zend_object std;
  SmUrlRouter *smr;
};


zend_function_entry smurlrouter_methods[] = {
    PHP_ME(SmUrlRouter , __construct, NULL, ZEND_ACC_PUBLIC | ZEND_ACC_CTOR)
    PHP_ME(SmUrlRouter , setRequest, NULL, ZEND_ACC_PUBLIC)
    PHP_ME(SmUrlRouter , setRouter, NULL, ZEND_ACC_PUBLIC)
    PHP_ME(SmUrlRouter , setRoute, NULL, ZEND_ACC_PUBLIC)
    PHP_ME(SmUrlRouter , run, NULL, ZEND_ACC_PUBLIC)
    //PHP_ME(SmUrlRouter , createUrl, NULL, ZEND_ACC_PUBLIC)
    //PHP_ME(SmUrlRouter , redirect, NULL, ZEND_ACC_PUBLIC)
    {NULL, NULL, NULL}
};


void smurlrouter_free_storage(void *object TSRMLS_DC)
{
  smurlrouter_object *obj = (smurlrouter_object*) object;
  delete obj->smr;

  zend_hash_destroy(obj->std.properties);
  FREE_HASHTABLE(obj->std.properties);

  efree(obj);
}

zend_object_value smurlrouter_create_handler(zend_class_entry *type TSRMLS_DC)
{
 
  zend_object_value retval;

  smurlrouter_object *obj = (smurlrouter_object*)emalloc(sizeof(smurlrouter_object));
  memset(obj, 0, sizeof(smurlrouter_object));
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

  retval.handle = zend_objects_store_put(obj, NULL, smurlrouter_free_storage,
      NULL TSRMLS_CC);
  retval.handlers = &smurlrouter_object_handlers;

  return retval;
}

/**
* 
*
* @param Smce\Ext\SmUrlRouter __construct
*/
PHP_METHOD(SmUrlRouter, __construct)
{
	
   SmUrlRouter *smr = NULL;
  
  
	smr = new SmUrlRouter();
	smurlrouter_object  *obj =(smurlrouter_object *) zend_object_store_get_object(
	getThis() TSRMLS_CC);
	
	if(obj->smr==NULL)
		obj->smr = smr;
 
}



/**
* 
*
* @param Smce\Ext\SmUrlRouter $setRequest
*/

PHP_METHOD(SmUrlRouter, setRequest)
{
	char* request;
	int request_len;
	SmUrlRouter *smr = NULL;
	
	smurlrouter_object  *obj =(smurlrouter_object *) zend_object_store_get_object(
getThis() TSRMLS_CC);
	smr=obj->smr;
	
	
    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &request,&request_len) == FAILURE) {
        RETURN_NULL();
    }
    
    if(smr != NULL) {
		smr->setRequest(request,request_len);
	}
	
    RETURN_TRUE;
}

/**
* 
*
* @param Smce\Ext\SmUrlRouter $setRouter
*/

PHP_METHOD(SmUrlRouter, setRouter)
{
	
	 zval *router;
	 SmUrlRouter *smr = NULL;
	
	smurlrouter_object  *obj =(smurlrouter_object *) zend_object_store_get_object(
getThis() TSRMLS_CC);
	smr=obj->smr;
	
    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "z", &router) == FAILURE) {
        RETURN_NULL();
    }
    
	 if(smr != NULL) {
		smr->setRouter(router);
	}
	
    RETURN_TRUE;
}


/**
* 
*
* @param Smce\Ext\SmUrlRouter $setRoute
*/

PHP_METHOD(SmUrlRouter, setRoute)
{
	 char *route;
	 int route_len;
	 SmUrlRouter *smr = NULL;
	
	smurlrouter_object  *obj =(smurlrouter_object *) zend_object_store_get_object(
getThis() TSRMLS_CC);
	smr=obj->smr;
	
    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &route,&route_len) == FAILURE) {
        RETURN_NULL();
    }
    
	 if(smr != NULL) {
		smr->setRoute(route,route_len);
	}
	
    RETURN_TRUE;
}



PHP_METHOD(SmUrlRouter, run)
{
	zval* requestArray;
	
	SmUrlRouter *smr = NULL;
	smurlrouter_object  *obj =(smurlrouter_object *) zend_object_store_get_object(
getThis() TSRMLS_CC);
	smr=obj->smr;
	
	
	if(smr != NULL) {
	
		array_init(return_value);
		
		add_assoc_string(return_value, "controller", smce_string_to_char(""),1);
		
		add_assoc_string(return_value, "view", smce_string_to_char(""),1);
		
		requestArray=return_value;
		
		smr->requestArray=return_value;
		
	
		if(smr->getRequest()== NULL){
			
			add_assoc_string(return_value, "controller", smce_string_to_char("site"),1);
		
			add_assoc_string(return_value, "view", smce_string_to_char("index"),1);
			
			requestArray=return_value;
		}else{
			
			
			if(Z_LVAL_P(smce_array_get_value_zval(smr->getRouter(),"showScriptName"))==false){
				
				
				if(smr->getRoute()!=NULL){
					HashTable *routeEx_hash;
					
					zval zdelim, zroute;
					ZVAL_STRINGL(&zroute, smr->getRoute(), smr->getRoute_len(), 0);
					ZVAL_STRINGL(&zdelim, smce_string_to_char("/"), 1, 0);
					array_init(return_value);
					php_explode( &zdelim,&zroute, return_value, LONG_MAX);
					
					
					 if(Z_TYPE_P(smce_array_get_index_zval(return_value,0))!= IS_NULL &&
					  Z_TYPE_P(smce_array_get_index_zval(return_value,1))!= IS_NULL){
						 RETURN_STRING("3",1);
						 
						 array_init(return_value);
						 add_assoc_string(return_value, "controller", Z_STRVAL_P(smce_array_get_index_zval(return_value,0)),1);
						 add_assoc_string(return_value, "view", Z_STRVAL_P(smce_array_get_index_zval(return_value,0)),1);
						 
						 requestArray=return_value;
					}
					
					
				}
				
				RETURN_STRING("2",1);
			
			}else{
				RETURN_STRING("1",1);
			}
		}
		
	}
	
	RETURN_TRUE;
	
	
}


//PHP_METHOD(SmUrlRouter, createUrl);
//PHP_METHOD(SmUrlRouter, redirect);
