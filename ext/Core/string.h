#ifndef SMCE_BASE_STRING_H_H
#define SMCE_BASE_STRING_H_H 


static char* smce_string_to_char(string str)
{
	char *cstr1= new char[str.length() + 1];
	strcpy(cstr1, str.c_str());
	return cstr1;
}


static zval* smce_string_to_zval(string str)
{
	zval* del;
	ZVAL_STRING(del, smce_string_to_char(str), 0);
	
	return del;
}


#endif
