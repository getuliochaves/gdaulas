<?php
if(isset($_POST) && !empty($_POST)){
define( 'SHORTINIT', true );
$pagePath = explode('wp-content', dirname(__FILE__));	
header('Content-Type: text/html; charset=UTF-8');
include_once($pagePath[0].'/wp-load.php');
global $wpdb;
$dados = $_POST;
$idPagina = $_POST['idPagina'];
$aula = $_POST['aula'];
$remover = $_POST['remover'];
if($remover == 'sim'){
	$tituloaula = '*aula'.$aula.'*';
	$deletaMetas = $wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key like '%$tituloaula%' AND post_id = '$idPagina'");
	echo 'Aula '.$aula.' foi removida.';	
	}else{
$nomeaula = $_POST['nomeaula'];
$codigovideo = $_POST['codigovideo'];



$itemaula = '*aula'.$aula.'*';
$tituloaula = $itemaula.$nomeaula;
$pegaaula = $wpdb->get_var("SELECT meta_id FROM $wpdb->postmeta WHERE meta_key like '%$itemaula%' AND post_id = '$idPagina'");
$contaaula = count($pegaaula);

if($contaaula == 0){
	$wpdb->insert($wpdb->postmeta, array('post_id' => $idPagina,'meta_key' => $tituloaula,'meta_value' => $codigovideo));	
}
if($contaaula > 0){	
	$grava = $wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '$tituloaula', meta_value = '$codigovideo' WHERE meta_id = '$pegaaula'");	
	}
	
$pegaprotecao = $wpdb->get_var("SELECT meta_id FROM $wpdb->postmeta WHERE meta_key = 'gd_protecaoaulas' AND post_id = '$idPagina'");


$nomelimpoaula = 'aula'.$aula;

$nivelaluno = $_POST['nivelaluno'];
//var_dump($nivelaluno);
$pacotesop = $_POST['pacotesop'];
//var_dump($pacotesop);

$contaprotecao = count($pegaprotecao);
//var_dump($contaprotecao);

//var_dump($arrayprotecao);

if($contaprotecao == 0){	
	$arrayprotecao = array();	
	$arrayprotecao[$nomelimpoaula]['nivelaluno'] = $nivelaluno;
	$arrayprotecao[$nomelimpoaula]['pacotes'] = $pacotesop;	
	$arrayprotecao = serialize($arrayprotecao);
	
	$wpdb->insert($wpdb->postmeta, array('post_id' => $idPagina,'meta_key' => 'gd_protecaoaulas','meta_value' => $arrayprotecao));	
}
if($contaprotecao > 0){	
$arrayprotecao = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'gd_protecaoaulas' AND post_id = '$idPagina'");

$arrayprotecao = unserialize($arrayprotecao);
$arrayprotecao[$nomelimpoaula]['nivelaluno'] = $nivelaluno;
$arrayprotecao[$nomelimpoaula]['pacotes'] = $pacotesop;	
$arrayprotecao = serialize($arrayprotecao);

var_dump(unserialize($arrayprotecao));
/*
if($arrayprotecao[$nomelimpoaula]){
	echo 'tem aula';
	}else{
	echo 'nao tem aula';
		}
//echo $nomelimpoaula;
*/

	$grava = $wpdb->query("UPDATE $wpdb->postmeta SET meta_key = 'gd_protecaoaulas', meta_value = '$arrayprotecao' WHERE meta_id = '$pegaprotecao'");
		
	}	

	
};//Fim else
};
?>