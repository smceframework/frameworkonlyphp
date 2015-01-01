/*!
 * \brief   Php Extension Writing with Zend to wrapp c++ classes.
 *
 * This file is the implementation of Wrapping C++ Classes in a PHP Extension by
 * Paul Osman.
 *
 * \see     http://devzone.zend.com/article/4486
 */
#ifndef PHP_SMCEFRAMEWORK_H
#define PHP_SMCEFRAMEWORK_H

#define PHP_SMCEFRAMEWORK_VERSION "0.0.1"
#define PHP_SMCEFRAMEWORK_EXTNAME "Smce Framework (PHP/C++)"

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif


#include "php.h"

#ifdef ZTS
#include "TSRM.h"
#endif

PHP_MINIT_FUNCTION(smceframework);
PHP_METHOD(SmRouter, hello);

extern zend_module_entry smframework_module_entry;
#define phpext_smceframework_ptr &vehicles_module_entry;

#endif

