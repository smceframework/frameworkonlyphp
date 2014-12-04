<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />


<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Smce::app()->baseUrl; ?>/front/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Smce::app()->baseUrl; ?>/front/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Smce::app()->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Smce::app()->baseUrl; ?>/front/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Smce::app()->baseUrl; ?>/front/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Smce::app()->baseUrl; ?>/front/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Smce::app()->baseUrl; ?>/front/css/menu.css" />
	<script type="text/javascript" src="<?php echo Smce::app()->baseUrl; ?>/front/js/menu.js"></script>
	<title>Smceframework</title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><a href="<?php echo Smce::app()->createUrl("site/index"); ?>"><img src="<?php echo Smce::app()->baseUrl; ?>/front/images/logo.jpg"/></a></div>
	</div><!-- header -->

<div id="mainmenu">

    <div id='csSmenu'>

        <ul>
           <li class="<?php if(Smce::app()->caControl(array("site/index")))echo "active";?>"><a href='<?php echo Smce::app()->createUrl("site/index"); ?>'>Home</a></li>
           <li class="<?php if(Smce::app()->caControl(array("themebasic/index")))echo "active";?>"><a href='<?php echo Smce::app()->createUrl("themebasic/index"); ?>'>Theme Basic</a></li>
           <li class="<?php if(Smce::app()->caControl(array("validation/index")))echo "active";?>"><a href='<?php echo Smce::app()->createUrl("validation/index"); ?>'>Validation</a></li>
           <li class='has-sub'><a href='#'>Menu</a>
              <ul>
                 <li class='has-sub'><a href='#'>Product 1</a>
                    <ul>
                       <li><a href='#'>Sub Product</a></li>
                       <li><a href='#'>Sub Product</a></li>
                    </ul>
                 </li>
                 <li class='has-sub'><a href='#'>Product 2</a>
                    <ul>
                       <li><a href='#'>Sub Product</a></li>
                       <li><a href='#'>Sub Product</a></li>
                    </ul>
                 </li>
              </ul>
           </li>
           
           
            <li><a href='<?=Smce::app()->createUrl("router/index",array("veriA"=>"SmceFramework","veriB"=>"3123554"));?>'>Router</a></li>
            
           <li class="<?php if(Smce::app()->caControl(array("site/about")))echo "active";?>"><a href='<?=Smce::app()->createUrl("site/about");?>'>About</a></li>



           <?php
		   $name=Smce::app()->getState("name");
		   if(empty($name)):?>
             <li class="<?php if(Smce::app()->caControl(array("site/login")))echo "active";?>"><a href='<?=Smce::app()->createUrl("site/login");?>'>Login</a></li>
           <?php endif;?>

          <?php if(!empty($name)):?>
                <li><a href='<?=Smce::app()->createUrl("site/logout");?>'>Logout (<?php echo Smce::app()->getState("name");?>)</a></li>
            <?php endif;?>

        </ul>
    </div><!-- csSmenu -->

</div><!-- mainmenu -->
