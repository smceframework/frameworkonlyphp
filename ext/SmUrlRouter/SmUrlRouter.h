
/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */
 
#ifndef SMCE_EXT_SMURLROUTER_SMROUTER_H
#define SMCE_EXT_SMURLROUTER_SMROUTER_H


class SmUrlRouter
{
  public:
	SmUrlRouter();
	
    void setRequest(char* request,int request_len);
    void setRouter(zval* router);
    void setRoute(char* route,int route_len);
    
    char* getRequest(void);
    int getRequest_len(void);
    
    char* getRoute(void);
    int getRoute_len(void);
    
    zval* getRouter(void);
    
    
	zval* requestArray;
	zval* routeGetEx;
	zval* explodeEx;
    
  private:
	char* request;
	int request_len;
	
	char* route;
	int route_len;
	
	zval* router;
	
};


#endif
