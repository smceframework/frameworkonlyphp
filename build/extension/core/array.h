
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */


#ifndef SMCE_CORE_SMCE_H_H
#define SMCE_CORE_SMCE_H_H 

#include "../../php_smceframework.h"

#include "string.h"


char* smce_array_get_value_string(zval* arr,string index);


zval* smce_array_get_value_zval(zval* arr,string index);


zval* smce_array_get_index_zval(zval* arr,ulong index);


#endif
