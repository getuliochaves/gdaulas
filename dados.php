<?php
if(isset($_POST) && !empty($_POST)){
define( 'SHORTINIT', true );
$pagePath = explode('wp-content', dirname(__FILE__));
?>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<?php
include_once($pagePath[0].'/wp-load.php');
global $wpdb;
$dados = $_POST;
$idPagina = $_POST['idPagina'];
$aula = $_POST['aula'];
$remover = $_POST['remover'];
$protecao = $_POST['protecao'];
$modifica = $_POST['modifica'];
$conteudobotao = $_POST['conteudobotao'];
$gravaCor = $_POST['gravaCor'];
$enviarxml = $_POST['enviarxml'];
$importagd = $_POST['importagd'];
$exluirarquivos = $_POST['exluirarquivos'];



if($exluirarquivos == 'sim'){
	$pasta = ABSPATH.'wp-content/uploads/xmlgdaulas/*.zip';
	array_map("unlink", glob( $pasta ));
	echo '<h3>Todos os arquivos foram Excluidos.</h3>';
};

if($enviarxml == 'sim'){

	$pegaaula = $wpdb->get_results("SELECT meta_key,meta_value FROM $wpdb->postmeta WHERE meta_key like '%*aula%' AND post_id = '$idPagina' ORDER BY meta_key ASC");
	//var_dump($pegaaula);

	//Abrindo documento xml
	$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>". PHP_EOL;

	//Abre bloco do xml
	$xml .= "<listaaulas>". PHP_EOL;
	$xml .= "<aulas>". PHP_EOL;

	foreach($pegaaula as $listaaulas111){
		$nomeAula = $listaaulas111->meta_key;
		$dadosAula = $listaaulas111->meta_value;
			$xml .= "<nomeAula>$nomeAula</nomeAula>". PHP_EOL;
			$xml .= "<dadosAula>$dadosAula</dadosAula>". PHP_EOL;
	}


	$xml .= "</aulas>". PHP_EOL;
	//Fecha
	$xml .= "</listaaulas>";

	$caminhoGerar = ABSPATH.'wp-content/uploads/';

	//var_dump($caminhoGerar);
	$dataHoje = date('d-m-Y');
	$nomeArquivo = 'aulas-'.$dataHoje.'.xml';
	$nomeFinal = $caminhoGerar.$nomeArquivo;
	file_put_contents($nomeFinal,$xml);



	$httpURL = strtolower(preg_replace('/[^a-zA-Z]/','',$_SERVER['SERVER_PROTOCOL']));
	$pegaUrl1 = $_SERVER['REQUEST_URI'];
	$pegaUrl2 = explode('wp-content', $pegaUrl1);
	$pegaSite = $pegaUrl2[0];

	if(!file_exists($caminhoGerar.'xmlgdaulas')){
		mkdir($caminhoGerar.'xmlgdaulas');
	};

	if(file_exists($caminhoGerar.'/xmlgdaulas/aulas-'.$dataHoje.'.zip')){
	unlink($caminhoGerar.'/xmlgdaulas/aulas-'.$dataHoje.'.zip');
	};

$zip = new ZipArchive();

if( $zip->open($caminhoGerar.'/xmlgdaulas/aulas-'.$dataHoje.'.zip' , ZipArchive::CREATE )  === true){
$zip->addFile($nomeFinal, $nomeArquivo);
echo '<h3>Aulas Exportadas Com sucesso. Clique para Baixar.<h3>';

$urlArquivo = $httpURL.'://'.$_SERVER['HTTP_HOST'].$pegaSite.'wp-content/uploads/xmlgdaulas/aulas-'.$dataHoje.'.zip';
echo '<a href="'.$urlArquivo.'" target="_blank" class="button button-primary button-large">Clique para Baixar seu Arquivo</a>';
  $zip->close();
}else{
echo '<h3>Falha Exportar Aulas.<h3>';
};
if(file_exists($nomeFinal)){
unlink($nomeFinal);
};
};


if($importagd == 'sim'){
$arquivogd = $_POST['arquivogd'];
$xml = simplexml_load_file($arquivogd);
$arrayxml = json_decode(json_encode($xml), TRUE);

//var_dump($xml);

$pegaDAUlas = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE post_id = '$idPagina' AND meta_key like '%*aula%'");
if(count($pegaDAUlas) == 0){
$wpdb->query("DELETE FROM $wpdb->postmeta WHERE post_id = '$idPagina' AND meta_key like '%*aula%'");
};


foreach ($arrayxml as $listaAulas88) {
	$nomeAulaLS = $listaAulas88[nomeAula];
	$dadosAulaLS = $listaAulas88[dadosAula];


	$posicao = 0;
	while(count($nomeAulaLS) > $posicao){
		$nomeAula = ($nomeAulaLS[$posicao]);
		$dadosAula = ($dadosAulaLS[$posicao]);

	//	var_dump($dadosAula);
	echo $nomeAula.'<br/>';
	echo $dadosAula.'<br/><br/>';

		$wpdb->insert($wpdb->postmeta, array('post_id' => $idPagina,'meta_key' => $nomeAula,'meta_value' => $dadosAula));
		$posicao++;
	};






	//var_dump($listaAulas88);
	//$nomeAula = $listaAulas88[0];
	//$dadosAula = $listaAulas88->dadosAula;

	//var_dump($nomeAula);

//	foreach ($nomeAula as $key) {
	//	var_dump($key);
	//}


//  $wpdb->insert($wpdb->postmeta, array('post_id' => $idPagina,'meta_key' => $nomeAula,'meta_value' => $dadosAula));

};

echo '<h3>Aulas Atualizadas Com sucesso!.</h3>';

};

if($gravaCor == 'sim'){
	$cor = $_POST['estiloCorArea'];

	$pegacor = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'estiloCor' AND post_id = '$idPagina'");
	$contaCor = count($pegacor);

	if($contaCor == 0){
		$wpdb->insert($wpdb->postmeta, array('post_id' => $idPagina,'meta_key' => 'estiloCor','meta_value' => $cor));
	}else{
		$wpdb->query("UPDATE $wpdb->postmeta SET meta_value = '$cor' WHERE meta_key = 'estiloCor' AND post_id = '$idPagina'");
	}

	echo '<h3>A cor desta area de membros foi alterada com sucesso. Clique no Botão Salvar Configurações!</h2>';
}


if($conteudobotao == 'sim'){

	$linkbotao = $_POST['linkbotao'];
	$textbotao = $_POST['textbotao'];
	$msgbotao = $_POST['msgbotao'];
	$destinobotao = $_POST['destinobotao'];


$pegaconfigbotao = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'configbotao' AND post_id = '$idPagina'");
$contaconfigbotao = count($pegaconfigbotao);

$montaconfigbotao = ['msgbotao' => $msgbotao, 'linkbotao' => $linkbotao, 'textbotao' => $textbotao, 'destinobotao' => $destinobotao];
$montaconfigbotao = serialize($montaconfigbotao);

if($contaconfigbotao == 0){
	$wpdb->insert($wpdb->postmeta, array('post_id' => $idPagina,'meta_key' => 'configbotao','meta_value' => $montaconfigbotao));
}

if($contaconfigbotao > 0){
$grava = $wpdb->query("UPDATE $wpdb->postmeta SET meta_value = '$montaconfigbotao' WHERE meta_key = 'configbotao' AND post_id = '$idPagina'");
}


}


if($protecao == 'sim'){
$pacotedosalunos = $_POST['pacotedosalunos'];
$niveldosalunos = $_POST['niveldosalunos'];
$nomeaula = '*';

$pegaaulaP = $wpdb->get_results("SELECT meta_key FROM $wpdb->postmeta WHERE meta_key like '%$nomeaula%' AND post_id = '$idPagina'");
$arrayprotecao = array();
foreach($pegaaulaP as $listaaulas){
$nomeaulainialgrava = explode('*',$listaaulas->meta_key);
$nomeaulafinalgrava = $nomeaulainialgrava[1];

$pegaprotecao = $wpdb->get_var("SELECT meta_id FROM $wpdb->postmeta WHERE meta_key = 'gd_protecaoaulas' AND post_id = '$idPagina'");
$contaprotecao = count($pegaprotecao);



$arrayprotecao[$nomeaulafinalgrava]['nivelaluno'] = $niveldosalunos;
$arrayprotecao[$nomeaulafinalgrava]['pacotes'] = $pacotedosalunos;

}
//var_dump($arrayprotecao);
$arrayprotecao = serialize($arrayprotecao);


if($contaprotecao == 0){
	$wpdb->insert($wpdb->postmeta, array('post_id' => $idPagina,'meta_key' => 'gd_protecaoaulas','meta_value' => $arrayprotecao));
}

if($contaprotecao > 0){
$grava = $wpdb->query("UPDATE $wpdb->postmeta SET meta_value = '$arrayprotecao' WHERE meta_key = 'gd_protecaoaulas' AND post_id = '$idPagina'");
}
}
if($remover == 'sim'){
	$tituloaula = '*aula'.$aula.'*';
	$deletaMetas = $wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key like '%$tituloaula%' AND post_id = '$idPagina'");
	echo 'Aula '.$aula.' foi removida.';
	}

if($modifica == 'sim'){
$nomeaula = $_POST['nomeaula'];
$codigovideoPost = $_POST['codigovideo'];
$codigovideoPost2 = base64_decode($codigovideoPost);
$codigovideo = base64_encode($codigovideoPost2);




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
$pacotesop = $_POST['pacotesop'];
$contaprotecao = count($pegaprotecao);
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


	$grava = $wpdb->query("UPDATE $wpdb->postmeta SET meta_key = 'gd_protecaoaulas', meta_value = '$arrayprotecao' WHERE meta_id = '$pegaprotecao'");

	}


};
};
?>
