
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */

#include "../../php_smceframework.h"


#include "array.h";

static char* smce_array_get_value_string(zval* arr,string index){
	HashTable *hash;
	zval **desc;
	
	hash = Z_ARRVAL_P(arr);
	if(zend_hash_find(hash,  smce_string_to_char(index), index.length()+1, (void**)&desc) != FAILURE)
	{
		return Z_STRVAL_PP(desc);
	}

}


static zval* smce_array_get_value_zval(zval* arr,string index){
	HashTable *hash;
	zval **desc;
	zval *d;
	
	hash = Z_ARRVAL_P(arr);
	if(zend_hash_find(hash,  smce_string_to_char(index), index.length()+1, (void**)&desc) != FAILURE)
	{
		
		ALLOC_INIT_ZVAL(d);
		*d=**desc;
		
		return d;
		
	}else{
		
		ALLOC_INIT_ZVAL(d);
		return d;
	}
    
}



static zval* smce_array_get_index_zval(zval* arr,ulong index){
	HashTable *hash;
	zval **desc;
	zval *d;
	
	hash = Z_ARRVAL_P(arr);
	if(zend_hash_index_find(hash,  index, (void**)&desc) != FAILURE)
	{
		
		ALLOC_INIT_ZVAL(d);
		*d=**desc;
		
		return d;
		
	}else{
		
		ALLOC_INIT_ZVAL(d);
		return d;
	}
    
}

