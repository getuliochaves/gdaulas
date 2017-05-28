<?php
global $wpdb;
include_once(base64_decode('aW5jX3Nwb3dlci5waHA='));
if($pg == 'reset'){
	
?>
<h4>Resetar Plugin</h4>
<?php
if($pg3 == 'ok'){
?>
<div class="alert alert-success">Chave removida com sucesso.</div>
<?php
};
?>

<?php
if($pg3 != 'limpa'){	
include_once('inc_list.php');
	if($vd_status == 0){ echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>'.$msAtc.'</div>';}else{
		$jsdfha = base64_decode('U2V1IFBsdWdpbiBFc3TDoSBhdGl2YWRvLiBWb2PDqiBwb2RlIHJlc2V0YXIgYSBjaGF2ZSwgY2xpY2FuZG8gbm8gYm90w6NvIGFiYWl4bzo=');
		echo '<div class="alert alert-success">'.$jsdfha.'</div>';		
		}
?>

   
      
      <div class="alert alert-danger"><?php echo base64_decode('QVRFTsOHw4NPOiBBbyByZXNldGFyLCBWb2PDqiB0ZXLDoSBxdWUgY29sb2NhciBhIGNoYXZlIG5vdmFtZW50ZS4u');?></div>
      <a href="admin.php?page=gdaulas&pg=reset&pg3=limpa" class="btn btn-success">Resetar Configurações</a>
      
<?php
include_once('inc_statusplugin.php');	
};
	 if($pg3 == 'limpa'){
		 
		echo '<div class="alert alert-success">Resetando Configurações, aguarde...</div>';	 
$deleta1 = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name = 'vd_gdaulas'");
$deleta2 = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name = 'siteexternogd'");	
$deleta3 = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name = 'sucessgd'");	
$deleta4 = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name = 'successgd'");	
	




		echo '<meta http-equiv="refresh" content="0; url=admin.php?page=gdaulas&pg=reset&pg3=ok">';
		 }
	 
	 ?> 
     
  <?php
};
  ?>   

