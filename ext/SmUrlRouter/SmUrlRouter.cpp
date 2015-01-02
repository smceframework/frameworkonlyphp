
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
#include "SmUrlRouter.h"

void SmUrlRouter::setRequest(char* req){
	
	request=req;
	
}

char* SmUrlRouter::getRequest(){
	
	return request;
	
}
