
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
#include "../../php_smceframework.h" 

#include "smrouter.h" 

#include "../../core/string.h"

#include "../../core/array.h"

PHP_METHOD(SmRouter, __construct);
PHP_METHOD(SmRouter, setRequest);
PHP_METHOD(SmRouter, setRouter);
PHP_METHOD(SmRouter, setRoute);
PHP_METHOD(SmRouter, run);
PHP_METHOD(SmRouter, array_get);
/*
PHP_METHOD(SmRouter, createUrl);
PHP_METHOD(SmRouter, redirect);
* */
 
zend_class_entry *smrouter_ce;
zend_object_handlers smrouter_object_handlers;

struct smrouter_object {
  zend_object std;
  SmRouter *smr;
};





zend_function_entry smrouter_methods[] = {
    PHP_ME(SmRouter , __construct, NULL, ZEND_ACC_PUBLIC | ZEND_ACC_CTOR)
    PHP_ME(SmRouter , setRequest, NULL, ZEND_ACC_PUBLIC)
    PHP_ME(SmRouter , setRouter, NULL, ZEND_ACC_PUBLIC)
    PHP_ME(SmRouter , setRoute, NULL, ZEND_ACC_PUBLIC)
    PHP_ME(SmRouter , run, NULL, ZEND_ACC_PUBLIC)
    PHP_ME(SmRouter , array_get, NULL, ZEND_ACC_PUBLIC)
    //PHP_ME(SmRouter , createUrl, NULL, ZEND_ACC_PUBLIC)
    //PHP_ME(SmRouter , redirect, NULL, ZEND_ACC_PUBLIC)
    {NULL, NULL, NULL}
};


void smrouter_free_storage(void *object TSRMLS_DC)
{
  smrouter_object *obj = (smrouter_object*) object;
  delete obj->smr;

  zend_hash_destroy(obj->std.properties);
  FREE_HASHTABLE(obj->std.properties);

  efree(obj);
}

zend_object_value smrouter_create_handler(zend_class_entry *type TSRMLS_DC)
{
 
  zend_object_value retval;

  smrouter_object *obj = (smrouter_object*)emalloc(sizeof(smrouter_object));
  memset(obj, 0, sizeof(smrouter_object));
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

  retval.handle = zend_objects_store_put(obj, NULL, smrouter_free_storage,
      NULL TSRMLS_CC);
  retval.handlers = &smrouter_object_handlers;

  return retval;
}

/**
* 
*
* @param Smce\Ext\SmRouter __construct
*/
PHP_METHOD(SmRouter, __construct)
{
	
   SmRouter *smr = NULL;
  
  
	smr = new SmRouter();
	smrouter_object  *obj =(smrouter_object *) zend_object_store_get_object(
	getThis() TSRMLS_CC);
	
	if(obj->smr==NULL)
		obj->smr = smr;
 
}



/**
* 
*
* @param Smce\Ext\SmRouter $setRequest
*/

PHP_METHOD(SmRouter, setRequest)
{
	char* request;
	int request_len;
	SmRouter *smr = NULL;
	
	smrouter_object  *obj =(smrouter_object *) zend_object_store_get_object(
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
* @param Smce\Ext\SmRouter $setRouter
*/

PHP_METHOD(SmRouter, setRouter)
{
	
	 zval *router;
	 SmRouter *smr = NULL;
	
	smrouter_object  *obj =(smrouter_object *) zend_object_store_get_object(
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
* @param Smce\Ext\SmRouter $setRoute
*/

PHP_METHOD(SmRouter, setRoute)
{
	 char *route;
	 int route_len;
	 SmRouter *smr = NULL;
	
	smrouter_object  *obj =(smrouter_object *) zend_object_store_get_object(
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



PHP_METHOD(SmRouter, run)
{
	zval* requestArray;
	
	SmRouter *smr = NULL;
	smrouter_object  *obj =(smrouter_object *) zend_object_store_get_object(
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
					
					if(parseurl->path!=NULL){
						zval zdelim, zrequest;
						ZVAL_STRINGL(&zrequest, parseurl->path,strlen(parseurl->path), 0);
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

PHP_METHOD(SmRouter, array_get)
{
	zval *routeEx, *arr, **desc, *arr2, **data;
	zval zdelim, zroute;
	char* route;
	int route_len;
	HashTable *hash, *has_a;
	HashTable *arr_hash;
	HashPosition pointer;
	
	
	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "as",&arr,&route,&route_len) == FAILURE) {
        RETURN_NULL();
    }
	
	ZVAL_STRINGL(&zroute, route,route_len, 1);
	ZVAL_STRINGL(&zdelim, ".", 1, 1);
	
	ALLOC_INIT_ZVAL(routeEx);
	array_init(routeEx);
	php_explode( &zdelim,&zroute, routeEx, LONG_MAX);
	 
	arr_hash= Z_ARRVAL_P(routeEx);
	
	
	hash = Z_ARRVAL_P(arr);
	
	for(zend_hash_internal_pointer_reset_ex(arr_hash, &pointer); 
		zend_hash_get_current_data_ex(arr_hash, (void**) &data, &pointer) == SUCCESS; 
		zend_hash_move_forward_ex(arr_hash, &pointer)) {
			
			ALLOC_INIT_ZVAL(arr2);
			array_init(arr2);
			if(zend_hash_find(hash,  Z_STRVAL_PP(data),Z_STRLEN_PP(data)+1, (void**)&desc) != FAILURE)
			{
				
				
				if(Z_TYPE_PP(desc) == IS_STRING)
					add_index_string(arr2,0,Z_STRVAL_PP(desc),1);
				else if(Z_TYPE_PP(desc) ==  IS_DOUBLE)
					add_index_double(arr2,0,Z_DVAL_PP(desc));
				else if(Z_TYPE_PP(desc) == IS_BOOL)
					add_index_bool(arr2,0,Z_BVAL_PP(desc));
				else if(Z_TYPE_PP(desc) == IS_LONG)
					add_index_long(arr2,0,Z_LVAL_PP(desc));
				else if(Z_TYPE_PP(desc) == IS_ARRAY){
					add_index_zval(arr2,0,*desc);
					
				}
				
				hash=Z_ARRVAL_P(*desc);
			}
			
			

	}
	
	hash = Z_ARRVAL_P(arr2);
	if(zend_hash_index_find(hash,  0, (void**)&desc) != FAILURE)
	{
			array_init(return_value);
			add_index_zval(return_value,0, *desc); 
	}else{
		array_init(return_value);
	    add_index_zval(return_value,0, arr2); 
	}

}


//PHP_METHOD(SmRouter, createUrl);
//PHP_METHOD(SmRouter, redirect);



PHP_MINIT_FUNCTION(smceframework)
{
	
  zend_class_entry ce;
  
  INIT_NS_CLASS_ENTRY(ce, "Smce\\Ext", "SmUrlRouter", smrouter_methods);
  smrouter_ce = zend_register_internal_class(&ce TSRMLS_CC);
  smrouter_ce->create_object = smrouter_create_handler;
  memcpy(&smrouter_object_handlers, zend_get_std_object_handlers(),
      sizeof(zend_object_handlers));
  smrouter_object_handlers.clone_obj = NULL;
  
  
  return SUCCESS;
  
}
