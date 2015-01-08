
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */

#include "../../php_smceframework.h"

#include "smrouter.h"


SmRouter::SmRouter()
{
	
}

void SmRouter::setRequest(char* req,int req_len){
	
	request=req;
	request_len=req_len;
	
}

void SmRouter::setRouter(zval* rout){
	
	router=rout;
	
}

void SmRouter::setRoute(char* rout,int rout_len){
	
	route=rout;
	route_len=rout_len;
}

char* SmRouter::getRequest(){
	
	return request;
	
}

int SmRouter::getRequest_len(){
	
	return request_len;
	
}

char* SmRouter::getRoute(){
	
	return route;
	
}

int SmRouter::getRoute_len(){
	
	return route_len;
	
}


zval* SmRouter::getRouter(){
	
	return router;
	
}


