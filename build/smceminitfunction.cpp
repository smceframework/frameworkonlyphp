

PHP_MINIT_FUNCTION(smceframework)
{
	zend_class_entry ce;
	INIT_NS_CLASS_ENTRY(ce, "Smce\\Ext", "SmRouter", smrouter_methods);
	smrouter_ce = zend_register_internal_class(&ce TSRMLS_CC);
	smrouter_ce->create_object = smrouter_create_handler;
	memcpy(&smrouter_object_handlers, zend_get_std_object_handlers(),
	sizeof(zend_object_handlers));
	smrouter_object_handlers.clone_obj = NULL;

	
	INIT_NS_CLASS_ENTRY(ce, "Smce\\Ext", "SmHelperc", smhelperc_methods);
	smhelperc_ce = zend_register_internal_class(&ce TSRMLS_CC);
	memcpy(&smhelperc_object_handlers, zend_get_std_object_handlers(),
	sizeof(zend_object_handlers));
	smhelperc_object_handlers.clone_obj = NULL;
	
	
	return SUCCESS;
}
