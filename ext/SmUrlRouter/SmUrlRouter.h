
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
	
    void setRequest(char* req);
    zval* setRouter(zval* router);
    
    char* getRequest(void);
    zval* getRouter(void);
    
  private:
	char *request;
	zval *router;
	zval *requestArray;
	zval *routeGetEx;
};


#endif
