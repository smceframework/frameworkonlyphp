
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */

#ifndef SMCE_BASE_STRING_H_H
#define SMCE_BASE_STRING_H_H 

#include "../../php_smceframework.h" 


static char* smce_string_to_char(string str)
{
	
	char *cstr1= new char[str.length() + 1];
	strcpy(cstr1, str.c_str());
	return cstr1;
	
}

static string smce_char_to_string(char* chr)
{
	string str(chr);
	return chr;
}


static zval* smce_string_to_zval(string str)
{
	zval* del;
	ZVAL_STRING(del, smce_string_to_char(str), 0);
	
	return del;
}




#endif
