<?php
//define a base do sistema
$baseSistema = get_site_url().'/wp-content/plugins/gdaulas/sistema/';
//define pagina de dados
$pgdados = $baseSistema.'pgdados.php';

//Define quais ids foram passados pelo shortcode
$idDoModuloIni = $atts['iddomodulo'];
$idDoModuloEx = explode(',',$idDoModuloIni);
$idDoModulo = $idDoModuloEx[0];
//Caso o Id seja nulo, pega o ID do Post Atual
if($idDoModulo == null){
	$idDoModulo = get_the_ID();
}
 ?>
