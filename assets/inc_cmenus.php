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
if($page == 'gdaulas'){	
?>
<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="admin.php?page=gdaulas&pg=ativar&pg2=verificando" name="formularioProd">

<h3>Ativar gdaulas</h3>

<?php
if($pg == 'ativar' && $pg2 == 'verificando'){
	echo '<div class="alert alert-warning"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
  '.$vKK.'</div>';
  
}

if($pg2 == 'nao' && $pg != ''){
	echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
  '.$errorK.'</div>';		
}

if($pg == ''){
	echo '<div class="alert alert-info"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> '.$irAt.'</div>';		
}

?>


<div class="form-group">
    <label for="inputText" class="col-sm-3 control-label">Gerar Codigo para o site:</label>
    <div class="col-sm-9">
<input type="text" class="form-control siteExternoO" readonly id="inputText" placeholder="" onClick="this.select()" value="<?php echo $geraCodSite;?>" name="siteExternoO">
    </div>
  </div> 
      <div class="form-group">
    <label for="inputText" class="col-sm-3 control-label">Código de Ativação:</label>
    <div class="col-sm-9">
<input type="text" class="form-control" id="inputText" placeholder="" value="<?php echo $uK;?>" name="success_gdaulas">
    </div>
  </div>   
  

<div class="form-group">
    <div class="col-sm-offset-9 col-sm-8">
      <button type="submit" class="btn btn-primary btn-lg">Atualizar Configurações</button>
    </div>
  </div> 
 </form>
 
<?php
};
?>
 
 
		</div>
	</div> 
		</div>
	</div> 
