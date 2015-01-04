
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

void SmUrlRouter::setRequest(char* req,int req_len){
	
	request=req;
	request_len=req_len;
	
}

void SmUrlRouter::setRouter(zval* rout){
	
	router=rout;
	
}

void SmUrlRouter::setRoute(char* rout,int rout_len){
	
	route=rout;
	route_len=rout_len;
}

char* SmUrlRouter::getRequest(){
	
	return request;
	
}

int SmUrlRouter::getRequest_len(){
	
	return request_len;
	
}

char* SmUrlRouter::getRoute(){
	
	return route;
	
}

int SmUrlRouter::getRoute_len(){
	
	return route_len;
	
}


zval* SmUrlRouter::getRouter(){
	
	return router;
	
}


