#ifndef SMCE_BASE_SMCE_H_H
#define SMCE_BASE_SMCE_H_H 


static char* smce_string_to_char(string str)
{
	char *cstr1= new char[str.length() + 1];
	strcpy(cstr1, str.c_str());
	return cstr1;
}



static char* smce_array_get_value(zval* arr,string index){
	
	zval **data;
    HashTable *arr_hash;
    HashPosition pointer;
    int array_count;

    arr_hash = Z_ARRVAL_P(arr);
    array_count = zend_hash_num_elements(arr_hash);

    

    for(zend_hash_internal_pointer_reset_ex(arr_hash, &pointer); 
    zend_hash_get_current_data_ex(arr_hash, (void**) &data, &pointer) == SUCCESS; 
    zend_hash_move_forward_ex(arr_hash, &pointer)) {
	zval temp;
	
		char *key;
		uint key_len;
		ulong indexa;

		if (zend_hash_get_current_key_ex(arr_hash, &key, &key_len, &indexa, 0, &pointer) == HASH_KEY_IS_STRING) {
			string str(key);
			if(str==index){
				temp = **data;
				zval_copy_ctor(&temp);
				convert_to_string(&temp);
				return Z_STRVAL(temp);
			    break;
			}
			
		} 
			
    }
    

}

#endif
