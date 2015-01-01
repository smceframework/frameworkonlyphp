#include "SmRouter.h"

char* SmRouter::hello(string a){
	
	char *cstr = new char[a.length() + 1];
	strcpy(cstr, a.c_str());
	return cstr ;
	
}

