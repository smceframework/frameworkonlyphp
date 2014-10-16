<?php
	
  
	// Independent Publisher Media Group ID is 1
	$independentPublishersMediaGroupID = 1;
	// Social Media Account codes are 0=fb_page, 1=tw, 2=linkedin
	// OwnerType codes are 3=media, 1=person, 4=department,5=mediaoffice, 6=mediagroup, 8=agency 


	
	$debug = true;
	
	if($debug){
		ini_set('display_errors', 1);
		error_reporting(E_ALL ^ E_NOTICE);
	}
	
	define("DB_USER","root");
	define("DB_PASSWORD","fy23tz98");
	define("DB_NAME","faselis");
	define("DB_HOST","localhost");
	
	
	/* Twitter KEY ve SECRET Ayarı*/
	
	define("twitter_oauth_access_token","366328718-GlBW4tU0UlajonnjVO5G58cnkXFym6WlowUfcN30");
	define("twitter_oauth_access_token_secret","TvGOpMbCWSf07Dddj5POnUV684CUrB4BpYedpl2q89rK5");
	define("twitter_consumer_key","4MHXYDzZHitAkvvvi7zzEyG0Z");
	define("twitter_consumer_secret","k05xpPE0OwmVG3dcUqwhQrbwhUgg2QeIwr4R7me2mpMRiVrUTr");
	
	/*Twitter KEY ve SECRET Ayarı*/
	
	

	global $parameterTypes;
	$parameterTypes["mediaDepartmentTypes"] = 45;
	$parameterTypes["mediaAudienceTypes"] = 46;
	$parameterTypes["mediaSubjectTypes"] = 47;
	$parameterTypes["mediaSectorTypes"] = 43;
 	$parameterTypes["mediaTypes"] = 40;
	$parameterTypes["mediaPeriods"] = 42;
	$parameterTypes["mediaAreas"] = 41;
	$parameterTypes["personPositionTypes"] = 10; // people position
	$parameterTypes["personTitleTypes"] = 11; // people title
	$parameterTypes["personInteresTypes"] = 13; // people interest


?>