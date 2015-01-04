#ifndef SMCE_BASE_SMCE_H_H
#define SMCE_BASE_SMCE_H_H 




static char* smce_array_get_value_string(zval* arr,string index){
	HashTable *hash;
	zval **desc;
	
	hash = Z_ARRVAL_P(arr);
	if(zend_hash_find(hash,  smce_string_to_char(index), 2, (void**)&desc) == FAILURE)
		return NULL;
	else
		return Z_STRVAL_PP(desc);
	

}


static zval* smce_array_get_value_zval(zval* arr,string index){
	HashTable *hash;
	zval **desc;
	zval *d;
	
	hash = Z_ARRVAL_P(arr);
	if(zend_hash_find(hash,  smce_string_to_char(index), index.length()+1, (void**)&desc) == FAILURE)
		return NULL;
	else{
		ALLOC_INIT_ZVAL(d);
		*d=**desc;
		return d;
	}
    
}


static zval* smce_array_get_index_zval(zval* arr,ulong index){
	HashTable *hash;
	zval **desc;
	zval *d;
	
	hash = Z_ARRVAL_P(arr);
	if(zend_hash_index_find(hash,  index, (void**)&desc) == FAILURE)
		return NULL;
	else{
		ALLOC_INIT_ZVAL(d);
		*d=**desc;
		return d;
	}
    
}


#endif
