
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
#include "SmUrlRouter.h"


SmUrlRouter::SmUrlRouter()
{
	
}

void SmUrlRouter::setRequest(zval* req){
	
	request=req;
	
}

void SmUrlRouter::setRouter(zval* rout){
	
	router=rout;
	
}

zval* SmUrlRouter::getRequest(){
	
	return request;
	
}

zval* SmUrlRouter::getRouter(){
	
	return router;
	
}
