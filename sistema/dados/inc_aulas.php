<?php

//Recebe o ID da aula
//$idAula = $_POST['idAula'];
//Recebe o ID do Modulo
$idModulo = $_POST['idModulo'];
//Recebe id do array organizado
$idList = $_POST['idList'];
$estiloCor = $_POST['estiloCor'];



//var_dump($idList);
//var_dump($idModulo);

//var_dump($idList);

//Pega Aulas do Modulo Clicado
$PegaAulas = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE post_id = '$idModulo' AND meta_key LIKE '%*aula%' ORDER BY meta_key ASC");
//  var_dump($PegaAulas);
//Se tiver aulas, executa o foreach
if(count($PegaAulas) > 0){
//Foreach para orgnizar as aulas
foreach($PegaAulas as $chaves => $vetores) {
$nAula111 = $vetores->meta_key;
$nAula11 = explode('*', $nAula111);
$nAula1 = explode('aula',$nAula11[1]);
$nAula = $nAula1[1];
$tAula = $nAula11[2];
$nVideo = $vetores->meta_value;
$nMeta = $vetores->meta_id;
$novoArray[$nAula]['aula']=$nAula;
$novoArray[$nAula]['tAula']=$tAula;
$novoArray[$nAula]['nMeta']=$nMeta;
$novoArray[$nAula]['video']=$nVideo;
//$proximaAula = $chaves;
};//Fim do Foreach para Organizar as aulas

//Organizar o Array por ordem Asc(1,2,3,...)
ksort($novoArray);

$primeiraAula = reset($novoArray);
$ultimaAula = end($novoArray);
$totalAulas = count($novoArray);
$aulaAtual = current($novoArray[$idList]);
$videoAula = $novoArray[$idList];
$tituloAula = 'Aula '.$videoAula[aula].' - '.$videoAula[tAula];
};
  $display = 'style="display:none;"';

  //echo $ultimaAula[aula];


  //3



//Define proxima aula


if($primeiraAula[aula] < $idList){

   $diminuiAula = $idList - 1;
  $testeAula2 = $novoArray[$diminuiAula];

	 while($testeAula2 == null && $testeAula2[aula] < $primeiraAula[aula]){
      $diminuiAula--;
    $testeAula2 = $novoArray[$diminuiAula];
    }
  $anteriorAula = $testeAula2[aula];
  $display1 = 'style="display:block;"';
 // var_dump($anteriorAula);

}else{
 $display1 = 'style="display:none;"';
}


if($ultimaAula[aula] > $idList){
  $somaAula = $idList + 1;
  $testeAula = $novoArray[$somaAula];

 // var_dump($testeAula);
   // var_dump($idList);

    while($testeAula == null && $testeAula[aula] < $ultimaAula[aula]){
      $somaAula++;
      $testeAula = $novoArray[$somaAula];
    }
  $proximaAula = $testeAula[aula];


    $display2 = 'style="display:block;"';
  //var_dump($proximaAula);
}else{
 $display2 = 'style="display:none;"';
}

//Começa Validação
$capacidades = $_POST['capacidades'];
$niveisdeacesso = $_POST['niveisdeacesso'];

$capacidades = unserialize($capacidades);
$niveisdeacesso = unserialize($niveisdeacesso);

//var_dump($capacidades);
//var_dump($niveisdeacesso);

$pegaprotecaoaulas = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'gd_protecaoaulas' AND post_id = '$idModulo'");
$protecaoAulas = unserialize($pegaprotecaoaulas);
$aulaProt = $protecaoAulas[aula.$idList];
//var_dump($aulaProt);


//Verifica se a aula é publica
if($aulaProt[nivelaluno] == 'publica' or $aulaProt[nivelaluno] == ''){
$validaPacote = true;
$validaNivel = true;
}
//Else caso a aula nao seja publica
else{

if($capacidades != ''){
$validaPacoteAdm = array_key_exists('administrator',$niveisdeacesso);

//Valida Admin
if($validaPacoteAdm == true){

$validaPacote = true;
$validaNivel = true;

//Se nao for admin
}else{


	//Valida Capacidade
	$nivelAluno = $aulaProt[nivelaluno];
	if($nivelAluno == 'subscriber'){
		$nivelAluno = 'optimizemember_level0';
		$nivelAcessoAll = 'access_'.$nivelAluno;
	}else{
		$nivelAcessoAll = 'access_'.$nivelAluno;
	}
	//Coloca True se o array existe
	$validaNivel = array_key_exists($nivelAcessoAll,$niveisdeacesso);


	//Valida os Pacotes
	if($aulaProt[pacotes] == '' or $aulaProt[pacotes] == null){
		$validaPacote = true;
	}else{
		$rPacotes = $aulaProt[pacotes];
		$rPacotes = explode(',',$rPacotes);


		foreach($rPacotes as $opacote){
				//adiciona o nome do pacote ao optimizeMember
				$nomePacote = 'access_optimizemember_ccap_'.$opacote;
				//Se tiver o pacote, valida como true
				if(array_key_exists($nomePacote,$niveisdeacesso)){
					$validaPacote = true;
				}else{
					//Si nao tiver o pacote, valida como false
					$validaPacote = false;
				}//Fim Se tiver o pacote, valida como true
			}//Fim Foreach




		//$validaPacote = array_key_exists($nivelAcessoAll,$rPacotes);
	}//Fim else valida pacotes

//	$nivelAcessoAll = 'access_'.$aulaProt[nivelaluno];

	//var_dump($validaNivel);
//	$validaNivel = array_key_exists($nivelAcessoAll,$niveisdeacesso);


	}; //Fim Valida admin

};//Fim capacidaes diferente de vazio

};//Fim Verifica se a aula é publica


//Mostra o Video
if($validaPacote == true && $validaNivel == true ){
$CodigoVideo = base64_decode($videoAula[video]);

}
//Mostra o botao
else{

	$pegaconfigbotao = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'configbotao' AND post_id = '$idModulo'");
	if(count($pegaconfigbotao > 0)){
$listaconfigbotao = unserialize($pegaconfigbotao);
$monstratitulo = $listaconfigbotao['msgbotao'];
$monstralink = $listaconfigbotao['linkbotao'];
$monstratexto = $listaconfigbotao['textbotao'];
$destinobotao = $listaconfigbotao['destinobotao'];

	}else{
  $monstratitulo = 'Conteúdo Protegido. Para Acessa-lo adquira o Nosso treinamento clicando no botão abaixo:';
  $monstralink = '';
  $monstratexto = 'Quero Adquirir Agora';
   $destinobotao = '_self';
	}

	$CodigoVideo = '<div class="msgfinal">
	<h1>'.$monstratitulo.'</h1>
	</div>
	<div class="bt_final"><a href="'.$monstralink.'" target="'.$destinobotao.'">'.$monstratexto.'</a></div>';
};//fim Mostra o Botao
?>



<div class="col-md-9" style="margin-top:-20px !important;">

<div class="panel panel-<?php echo $estiloCor; ?>">
  <div class="list-group">

    <h3 class="tituloaula" style="margin:0;">
       <a href="#" class="list-group-item list-group-item-<?php echo $estiloCor; ?>"><i class="fa fa-youtube-play"></i>  <?php echo $tituloAula; ?></a>
    </h3>
  </div>
  <div class="panel-body">

    <div class="mostraVideo">
      <?php echo $CodigoVideo; ?>
    </div>

  </div>

  <div class="panel-footer antProx">
    <input type="hidden" class="moduloAltera" value="<?php echo $idModulo; ?>"/>
    <buttom <?php echo $display1; ?> class="btn btn-<?php echo $estiloCor; ?> btn-lg anterior Ant<?php echo $anteriorAula; ?>"><i class="fa fa-backward"></i>  Aula Anterior</buttom>
    <buttom <?php echo $display2; ?> class="btn btn-<?php echo $estiloCor; ?> btn-lg proxima Prox<?php echo $proximaAula; ?>"><i class="fa fa-forward"></i>  Proxima Aula</buttom>
  </div>

</div>
</div>
