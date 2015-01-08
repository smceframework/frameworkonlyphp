PHP_ARG_ENABLE(smceframework,	
  [ --enable-smceframework   Enable smceframework support])

AC_DEFUN([PHP_SMCEFRAMEWORK_ADD_SOURCES], [
	PHP_SMCEFRAMEWORK_SOURCES="$PHP_SMCEFRAMEWORK_SOURCES $1"
])

if test "$PHP_SMCEFRAMEWORK" = "yes"; then
  PHP_REQUIRE_CXX()
  PHP_SUBST(SMCEFRAMEWORK_SHARED_LIBADD)
  PHP_ADD_LIBRARY(stdc++, 1, SMCEFRAMEWORK_SHARED_LIBADD)
  
  PHP_SMCEFRAMEWORK_ADD_SOURCES([
		smceframework.cpp
		extension/core/array.cpp
		extension/core/string.cpp
		extension/smrouter/smrouter.cpp
		extension/smrouter/smrouterfunc.cpp
	])
  
  PHP_NEW_EXTENSION(smceframework,$PHP_SMCEFRAMEWORK_SOURCES,$ext_shared)
fi

