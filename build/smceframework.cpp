#include <string>
using namespace std; 
using std::string;

#include "smceframework.h"
#include "../ext/SmRouter/SmRouter.cc"
#include "../ext/SmRouter/SmRouterFunc.cc"



#ifdef COMPILE_DL_SMCEFRAMEWORK
ZEND_GET_MODULE(smceframework)
#endif


PHP_MINIT_FUNCTION(smceframework)
{
  zend_class_entry ce;
  INIT_CLASS_ENTRY(ce, "SmRouter", smrouter_methods);
  smrouter_ce = zend_register_internal_class(&ce TSRMLS_CC);
  smrouter_ce->create_object = smrouter_create_handler;
  memcpy(&smrouter_object_handlers, zend_get_std_object_handlers(),
      sizeof(zend_object_handlers));
  smrouter_object_handlers.clone_obj = NULL;
  return SUCCESS;
}
