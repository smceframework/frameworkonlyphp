<?php /* @var $this Controller */ ?><!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Welcome to SmceFramework</title>
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="chrome=1"><![endif]-->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="format-detection" content="telephone=no"/>
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />

  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,700,400italic">
  <link rel="stylesheet" type="text/css" href="<?php echo Smce::app()->baseUrl; ?>/front/css/reset.css">
  <link rel="stylesheet" type="text/css" href="<?php echo Smce::app()->baseUrl; ?>/front/css/styles.css">
  <link rel="stylesheet" type="text/css" href="<?php echo Smce::app()->baseUrl; ?>/front/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Smce::app()->baseUrl; ?>/front/css/form.css">
  <!--[if IE]><link href="http://www.3818.com.ar/styles/fix-old-ie.css" media="all" type="text/css" rel="stylesheet">
<![endif]-->
  <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <style type="text/css">
    #ads-sidebar{
      margin-right:15px!important;
    }
  </style>
</head>

<body style="padding-top:44px">
<!--[if IE]>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>
    <style>.chromeFrameInstallDefaultStyle { width: 100%; border: 5px solid #ffa700; }</style><div id="prompt"></div>
    <script>window.attachEvent("onload", function() {CFInstall.check({mode: "overlay", node: "prompt"});});</script>
<![endif]-->


<a class="scroll-point" id="home"></a>

<div id="top">
  <nav>
    <div class="logo clearfix"><a href="<?=Smce::app()->createUrl("site/index")?>"><h1><?php echo Smce::app()->appname;?></h1></a></div>
    <ul id="menu">
      <li><a href="<?=Smce::app()->createUrl("site/index");?>">Home</a></li>
      <li><a href="<?=Smce::app()->createUrl("site/helper");?>">Helper</a></li>
      <li><a href="<?=Smce::app()->createUrl("site/about");?>">About</a></li>
      <li><a href="<?=Smce::app()->createUrl("themebasic/index");?>">Theme</a></li>
      <li><a href="<?=Smce::app()->createUrl("router/index",array("veriA"=>"SmceFramework","veriB"=>"3123554"));?>">Router</a></li>

      <?php if(Smce::app()->getState("name")==""):?>
        <li><a href="<?=Smce::app()->createUrl("site/login");?>">Login</a></li>
      <?php else:?>
        <li><a href="<?=Smce::app()->createUrl("site/logout");?>">Logout</a></li>
      <?php endif;?>
    </ul>
    
    <a href="#menu-footer" class="menu-btn"></a>
  </nav>
</div>

  
