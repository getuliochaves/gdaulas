﻿<?php
if(isset($_POST) && !empty($_POST)){
define( 'SHORTINIT', true );
$pagePath = explode('wp-content', dirname(__FILE__));
include_once($pagePath[0].'/wp-load.php');
global $wpdb;


$baseSistema = $pagePath[0].'/wp-content/plugins/gdaulas/sistema/';
include_once('inclusoes.php');

$mudaModulo = $_POST['mudaModulo'];
$mudaAula = $_POST['mudaAula'];
//Inicia Aqui somente clicar em Muda Modulos
if($mudaModulo == 'sim'){
include_once($baseSistema.'/dados/inc_modulos.php');
};

//Inicia Condicao Quando clicar na aula
if($mudaAula == 'sim'){

include_once($baseSistema.'/dados/inc_aulas.php');
};

};//Fim Global
?>
