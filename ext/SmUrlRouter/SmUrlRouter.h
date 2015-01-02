
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
	SmUrlRouter(const int max_gear);
    void setRequest(char* req);
    char* getRequest(void);
    
	char *request;
	zval *router;
	zval *requestArray;
	zval *routeGetEx;
};


#endif
