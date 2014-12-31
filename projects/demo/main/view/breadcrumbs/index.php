<?php

use Smce\Widget\SmBreadcrumbs;

$SmBreadcrumbs=new SmBreadcrumbs;

echo $SmBreadcrumbs->newBreadcrumbs(array(
	"Admin"=>array('admin/index'),
	"Menu1"=>array('menu1/index'),
	"Menu2"=>array('menu2/index',array("id"=>1,"data"=>32)),
	"Hello"=>"",
));

?>
<br><br>
<h3>Breadcrumbs!</h3>
