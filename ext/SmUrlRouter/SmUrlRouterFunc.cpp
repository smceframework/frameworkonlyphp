
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
						
						char* index1= Z_STRVAL_P(smce_array_get_index_zval(return_value,0));
						char* index2= Z_STRVAL_P(smce_array_get_index_zval(return_value,1));
						 
						 array_init(return_value);
						 add_assoc_string(return_value, "controller",index1,1);
						 add_assoc_string(return_value, "view", index2,1);
						 
						 requestArray=return_value;
					}
					
					
				}
			
			}else{
					
					php_url *parseurl;
					
					parseurl = php_url_parse_ex(smr->getRequest(), smr->getRequest_len());
					
					RETVAL_STRING(parseurl->path,1);
					char* path=parseurl->path;
					
					if(path!=NULL){
						zval zdelim, zrequest;
						ZVAL_STRINGL(&zrequest, parseurl->path,strlen(path), 0);
						ZVAL_STRINGL(&zdelim, smce_string_to_char("/"), 1, 0);
						
						zval* explodeEx;
						ALLOC_INIT_ZVAL(explodeEx);
						array_init(explodeEx);
						php_explode( &zdelim,&zrequest, explodeEx, LONG_MAX);
					
						
						if(Z_TYPE_P(smce_array_get_index_zval(explodeEx,0))!= IS_NULL &&
						  Z_TYPE_P(smce_array_get_index_zval(explodeEx,1))!= IS_NULL){
							
							char* index1= Z_STRVAL_P(smce_array_get_index_zval(explodeEx,0));
							char* index2= Z_STRVAL_P(smce_array_get_index_zval(explodeEx,1));
							 
							 array_init(return_value);
							 add_assoc_string(return_value, "controller",index1,1);
							 add_assoc_string(return_value, "view", index2,1);
							 
							 zval *routerEx=smce_array_get_value_zval(smr->getRouter(),"router");
							if(Z_TYPE_P(smce_array_get_value_zval(routerEx,index1)) !=  IS_NULL){
								HashTable *arr;
								HashPosition pointer;
								zval **data;
								
								arr= Z_ARRVAL_P(smce_array_get_value_zval(routerEx,index1));
								int i=0;
								for(zend_hash_internal_pointer_reset_ex(arr, &pointer); 
								zend_hash_get_current_data_ex(arr, (void**) &data, &pointer) == SUCCESS; 
								zend_hash_move_forward_ex(arr, &pointer)) {
									
									if(Z_TYPE_P(smce_array_get_index_zval(explodeEx,i+2))	!=	IS_NULL)
										add_assoc_string(return_value, Z_STRVAL_PP(data),Z_STRVAL_P(smce_array_get_index_zval(explodeEx,i+2)),1);
									
									i++;
								}
								
							}else{
								HashTable *arr;
								HashPosition pointer;
								zval **data;
								
								arr= Z_ARRVAL_P(smce_array_get_value_zval(routerEx,"all"));
								int i=0;
								for(zend_hash_internal_pointer_reset_ex(arr, &pointer); 
								zend_hash_get_current_data_ex(arr, (void**) &data, &pointer) == SUCCESS; 
								zend_hash_move_forward_ex(arr, &pointer)) {
									
									if(Z_TYPE_P(smce_array_get_index_zval(explodeEx,i+2))	!=	IS_NULL)
										add_assoc_string(return_value, Z_STRVAL_PP(data),Z_STRVAL_P(smce_array_get_index_zval(explodeEx,i+2)),1);
									
									i++;
								}
							}
							
						}
						
						
					}
					
					
				}
		}
		
	}
	
}


//PHP_METHOD(SmUrlRouter, createUrl);
//PHP_METHOD(SmUrlRouter, redirect);
