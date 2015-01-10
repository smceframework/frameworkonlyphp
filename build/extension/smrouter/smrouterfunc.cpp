
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
#include "../../php_smceframework.h" 


#include "smrouter.h" 

#include "../core/string.h"

#include "../core/array.h"



PHP_METHOD(SmRouter, __construct);
PHP_METHOD(SmRouter, setRequest);
PHP_METHOD(SmRouter, setRouter);
PHP_METHOD(SmRouter, setRoute);
PHP_METHOD(SmRouter, run);
PHP_METHOD(SmRouter, createUrl);
PHP_METHOD(SmRouter, redirect);

 
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
    PHP_ME(SmRouter , createUrl, NULL, ZEND_ACC_PUBLIC)
    PHP_ME(SmRouter , redirect, NULL, ZEND_ACC_PUBLIC)
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
* @param Smce\Ext\SmRouter setRequest
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
* @param Smce\Ext\SmRouter setRouter
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
* @param Smce\Ext\SmRouter setRoute
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

/**
* 
*
* @param Smce\Ext\SmRouter run
*/

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
		
		
	
		if(smr->getRequest()== NULL || strlen(smr->getRequest())==0){
			
			add_assoc_string(return_value, "controller", smce_string_to_char("site"),1);
		
			add_assoc_string(return_value, "view", smce_string_to_char("index"),1);
			
		}else{
			
			
			if(Z_LVAL_P(smce_array_get_value_zval(smr->getRouter(),"showScriptName"))==false){
				
				
				if(smr->getRoute()!=NULL){
					
					zval zdelim, zroute;
					ZVAL_STRINGL(&zroute, smr->getRoute(), smr->getRoute_len(), 0);
					ZVAL_STRINGL(&zdelim, smce_string_to_char("/"), 1, 0);
					
					zval* explodeEx;
					ALLOC_INIT_ZVAL(explodeEx);
					array_init(explodeEx);
					php_explode( &zdelim,&zroute, explodeEx, LONG_MAX);
				
					
					if(Z_TYPE_P(smce_array_get_index_zval(explodeEx,0))!= IS_NULL &&
					  Z_TYPE_P(smce_array_get_index_zval(explodeEx,1))!= IS_NULL){
						
						char* index1= Z_STRVAL_P(smce_array_get_index_zval(explodeEx,0));
						char* index2= Z_STRVAL_P(smce_array_get_index_zval(explodeEx,1));
						 
						 array_init(return_value);
						 add_assoc_string(return_value, "controller",index1,1);
						 add_assoc_string(return_value, "view", index2,1);
						 
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

/**
* 
*
* @param Smce\Ext\SmRouter createUrl
*/

PHP_METHOD(SmRouter, createUrl)
{
	char *controllerView, *baseUrl, *STR, *STR2;
	int controllerViewLen, baseUrlLen;
	zval *array, **data;
	HashTable *arr_hash;
	HashPosition pointer;
	string s1, s2="";
	
	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "sas", &controllerView,&controllerViewLen,&array,&baseUrl,&baseUrlLen) == FAILURE) {
        RETURN_NULL();
    }
    
   
    SmRouter *smr = NULL;
	smrouter_object  *obj =(smrouter_object *) zend_object_store_get_object(
getThis() TSRMLS_CC);
	smr=obj->smr;
	
	
	if(Z_LVAL_P(smce_array_get_value_zval(smr->getRouter(),"showScriptName"))==true){
		 
		string s1=smce_char_to_string(baseUrl)+"/"+smce_char_to_string(controllerView);
		
		arr_hash= Z_ARRVAL_P(array);
		
		for(zend_hash_internal_pointer_reset_ex(arr_hash, &pointer); 
		zend_hash_get_current_data_ex(arr_hash, (void**) &data, &pointer) == SUCCESS; 
		zend_hash_move_forward_ex(arr_hash, &pointer)) {
			
			s2+="/";
			s2+=smce_char_to_string(Z_STRVAL_PP(data));
			
		}
		
		s1+=s2;
		
		STR=smce_string_to_char(s1);
	}else{
		
		string s1=smce_char_to_string(baseUrl)+"/index.php?route="+smce_char_to_string(controllerView);
		
		
		arr_hash= Z_ARRVAL_P(array);
		
		for(zend_hash_internal_pointer_reset_ex(arr_hash, &pointer); 
		zend_hash_get_current_data_ex(arr_hash, (void**) &data, &pointer) == SUCCESS; 
		zend_hash_move_forward_ex(arr_hash, &pointer)) {
			
			char *key;
			uint key_len;
			ulong index;
			
			zend_hash_get_current_key_ex(arr_hash, &key, &key_len, &index, 0, &pointer);
			
			s2+="&"+smce_char_to_string(key)+"="+smce_char_to_string(Z_STRVAL_PP(data));
			
			
		}
		
		s1+=s2;
		
		STR=smce_string_to_char(s1);
	}
	
	RETURN_STRING(STR,1);
    

}



/**
* 
*
* @param Smce\Ext\SmRouter redirect
*/

PHP_METHOD(SmRouter, redirect)
{
	char *controllerView, *baseUrl, *STR, *STR2;
	int controllerViewLen, baseUrlLen;
	zval *array, **data;
	HashTable *arr_hash;
	HashPosition pointer;
	string s1, s2="";
	
	sapi_header_line h = { NULL, 0, 0 };
	
	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "sas", &controllerView,&controllerViewLen,&array,&baseUrl,&baseUrlLen) == FAILURE) {
        RETURN_NULL();
    }
    
   
    SmRouter *smr = NULL;
	smrouter_object  *obj =(smrouter_object *) zend_object_store_get_object(
getThis() TSRMLS_CC);
	smr=obj->smr;
	
	
	if(Z_LVAL_P(smce_array_get_value_zval(smr->getRouter(),"showScriptName"))==true){
		 
		s1=smce_char_to_string(baseUrl)+"/"+smce_char_to_string(controllerView);
		
		arr_hash= Z_ARRVAL_P(array);
		
		for(zend_hash_internal_pointer_reset_ex(arr_hash, &pointer); 
		zend_hash_get_current_data_ex(arr_hash, (void**) &data, &pointer) == SUCCESS; 
		zend_hash_move_forward_ex(arr_hash, &pointer)) {
			
			s2+="/";
			s2+=smce_char_to_string(Z_STRVAL_PP(data));
			
		}
		
		s1+=s2;
		
	}else{
		
		s1=smce_char_to_string(baseUrl)+"/index.php?route="+smce_char_to_string(controllerView);
		
		
		arr_hash= Z_ARRVAL_P(array);
		
		for(zend_hash_internal_pointer_reset_ex(arr_hash, &pointer); 
		zend_hash_get_current_data_ex(arr_hash, (void**) &data, &pointer) == SUCCESS; 
		zend_hash_move_forward_ex(arr_hash, &pointer)) {
			
			char *key;
			uint key_len;
			ulong index;
			
			zend_hash_get_current_key_ex(arr_hash, &key, &key_len, &index, 0, &pointer);
			
			char *buff = new char[strlen(STR2)+1];
			sprintf(buff, "&%s=%s",key, Z_STRVAL_PP(data));
			s2+=buff;
			
			
		}
		
		s1+=s2;
		
	}
	
	string header="Location: "+s1;
	h.line = smce_string_to_char(header);
	h.line_len = header.length();
	sapi_header_op(SAPI_HEADER_REPLACE, &h TSRMLS_CC);
}




