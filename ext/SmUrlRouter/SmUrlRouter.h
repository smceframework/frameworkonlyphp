
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
	
    void setRequest(zval* request);
    void setRouter(zval* router);
    
    zval* getRequest(void);
    zval* getRouter(void);
    
	zval* requestArray;
	zval* routeGetEx;
    
  private:
	zval* request;
	zval* router;
};


#endif
