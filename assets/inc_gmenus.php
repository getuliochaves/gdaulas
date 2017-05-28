<?php
global $wpdb;
include_once(base64_decode('aW5jX3Bvd2VyLnBocA=='));
?>
<div class="panel panel-primary" style="width:93%;">
<div class="panel-heading"><h3><strong><?php echo $pmPro.' '.$versaoPlugin; ?></strong></h3></div>
<div class="panel-body">

<ul class="nav nav-tabs" style="margin-bottom:20px !important;">      
<?php

?>     
</ul>
<div class="panel panel-default">
<div class="panel-body">
<?php
if($page == 'gdaulas' && $pg == 'ativo'){	
if($pg == 'ativar' && $pg2 == 'verificando'){
	echo '<div class="alert alert-warning"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
  '.$vKK.'</div>';
  $codigoPlugin = $_POST['success_gdaulas'];
}

if($codigoPlugin == ''){
	$codigoPlugin = $sPMk;
}

if($pg2 == 'nao' && $pg != ''){
	echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
  '.$errorK.'</div>';		
}

if($pg == ''){
	echo '<div class="alert alert-success"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> '.$ggAt.'</div>';		
}

?>


 
<?php
};
if($page == 'gdaulas' && $pg = 'reset'){	
include_once('inc_reset.php');
};
?>

 
		</div>
	</div> 
		</div>
	</div> 
