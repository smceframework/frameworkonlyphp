
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
#include "../../php_smceframework.h" 


#include "../core/string.h"

#include "../core/array.h"



//PHP_METHOD(SmHelper, array_first);
//PHP_METHOD(SmHelper, array_last);
//PHP_METHOD(SmHelper, array_filter);
//PHP_METHOD(SmHelper, array_flatten);
PHP_METHOD(SmHelper, array_get);
//PHP_METHOD(SmHelper, array_sort);

 
zend_class_entry *smhelper_ce;
zend_object_handlers smhelper_object_handlers;


zend_function_entry smhelper_methods[] = {
    //PHP_ME(SmHelper , array_first, NULL, ZEND_ACC_PUBLIC)
    //PHP_ME(SmHelper , array_last, NULL, ZEND_ACC_PUBLIC)
    //PHP_ME(SmHelper , array_filter, NULL, ZEND_ACC_PUBLIC)
    //PHP_ME(SmHelper , array_flatten, NULL, ZEND_ACC_PUBLIC)
    PHP_ME(SmHelper , array_get, NULL, ZEND_ACC_PUBLIC)
    //PHP_ME(SmHelper , array_sort, NULL, ZEND_ACC_PUBLIC)
    {NULL, NULL, NULL}
};



/**
* 
*
* @param Smce\Ext\SmHelper array_get
*/

PHP_METHOD(SmHelper, array_get)
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

	ZVAL_STRINGL(&zroute, route,route_len, 0);
	ZVAL_STRINGL(&zdelim, ".", 1, 0);
	
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



//PHP_METHOD(SmHelper, array_first);
//PHP_METHOD(SmHelper, array_last);
//PHP_METHOD(SmHelper, array_filter);
//PHP_METHOD(SmHelper, array_flatten);
//PHP_METHOD(SmHelper, array_sort);


