<?php



  //pega o Id do Modulo
  $IDModuloAltera = $_POST['IDModuloAltera'];
  $estiloCor = $_POST['estiloCor'];

  //var_dump($IDModuloAltera);
  //Pega o Titulo do Modulo
  $tituloModulo = $wpdb->get_var("SELECT post_title FROM $wpdb->posts WHERE ID = '$IDModuloAltera'");

  //Pega Aulas do Modulo Clicado
  $PegaAulas = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE post_id = '$IDModuloAltera' AND meta_key LIKE '%*aula%' ORDER BY meta_key ASC");
//var_dump($PegaAulas);
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
$idList = $primeiraAula['aula'];

//var_dump($primeiraAula);

$tituloAula1 = 'Aula '.$primeiraAula[aula].' - '.$primeiraAula[tAula];

//Define proxima aula
if($ultimaAula[aula] != $idList){
  $somaAula = $idList + 1;
  $testeAula = $novoArray[$somaAula];
    while($testeAula == null){
      $somaAula++;
      $testeAula = $novoArray[$somaAula];
    }
  $proximaAula = $testeAula[aula];
    $display2 = 'style="display:block;"';
  //var_dump($proximaAula);
}//Fim define proxima aula

//Define  aula anterior
if($primeiraAula[aula] < $idList){
  $diminuiAula = $idList - 1;
  $testeAula2 = $novoArray[$diminuiAula];
    while($testeAula2 == null){
      $diminuiAula--;
    $testeAula2 = $novoArray[$diminuiAula];
    }
  $anteriorAula = $testeAula2[aula];
  $display = 'style="display:block;"';

  //var_dump($anteriorAula);
}//Fim aula anterior


//var_dump($idList);

?>



<!-- Inicio Coluna Menu Aulas -->
<div class="col-md-3">

		<div class="list-group lsmodulos ">
				<a href="#" class="list-group-item list-group-item-<?php echo $estiloCor; ?>"><i class="fa fa-graduation-cap"></i> <?php echo $tituloModulo; ?></a>
		<div class="list-group-item menuGeral">

			<ul>



			  <?php

        $pegaprotecaoaulas0 = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'gd_protecaoaulas' AND post_id = '$IDModuloAltera'");
        $protecaoAulas0 = unserialize($pegaprotecaoaulas0);


			  foreach($novoArray as $dadosaulas){
			  $numeroAula = $dadosaulas['aula'];
			  $tituloAula = $dadosaulas['tAula'];
			  $metaAula = $dadosaulas['nMeta'];
			  $videoAula = $dadosaulas['video'];
			  $nomeAula = 'Aula '.$numeroAula.' - '.$tituloAula;
        $tnAula = 'aula'.$numeroAula;
        $protecaoAula = $protecaoAulas0[$tnAula]['nivelaluno'];

        //var_dump($protecaoAula);

        if($protecaoAula == 'publica'){
          $bloqueio = '<i class="aulaAberta fa fa-folder-open-o"></i>';
        }else{
          $bloqueio = '';
        }
			  ?>
			        <li class="pegaIdAula <?php echo $numeroAula; ?>">
			        <span class="buletLi<?php echo $numeroAula; ?> selecaoBI"></span><?php echo $bloqueio; ?> <?php echo $nomeAula; ?>
			        </li>
			  <?php
			 // $dadosRetorno = 'Classe: pegaIdAula'.$numeroAula.' ---- Name: '.$IDModuloAltera. '---- id: '.$metaAula.'---- Nome da aula:'.$nomeAula;
			//  var_dump($dadosRetorno);
			  };
			  ?>
			</ul>



		</div>
	</div>
</div>
<!-- Fim Coluna Menu Aulas -->




<?php


//Começa Validação
$capacidades = $_POST['capacidades'];
$niveisdeacesso = $_POST['niveisdeacesso'];

$capacidades = unserialize($capacidades);
$niveisdeacesso = unserialize($niveisdeacesso);

//var_dump($capacidades);
//var_dump($niveisdeacesso);
//var_dump($idList);

$pegaprotecaoaulas = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'gd_protecaoaulas' AND post_id = '$IDModuloAltera'");
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

	}; //Fim Valida admin

};

};//Fim Verifica se a aula é publica


//Mostra o Video
if($validaPacote == true && $validaNivel == true ){
$videoAula = $novoArray[$idList];
$CodigoVideo = base64_decode($videoAula[video]);

}
//Mostra o botao
else{

	$pegaconfigbotao = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'configbotao' AND post_id = '$IDModuloAltera'");
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

	$CodigoVideo = '<div class="msgfinal"><h1>'.$monstratitulo.'</h1></div>
<div class="bt_final"><a href="'.$monstralink.'" target="'.$destinobotao.'">'.$monstratexto.'</a></div>';
};//fim Mostra o Botao

$descricaoaula1 = $aulaProt['descricaoaula'];
$descricaoaula = base64_decode($descricaoaula1);
//var_dump($aulaProt);

 ?>



 <div class="videoGeral">
  <div class="conteudoVideo">

 <!-- Inicio Coluna Video -->
 <div class="col-md-9" style="margin-top:-20px !important;">

 <div class="panel panel-<?php echo $estiloCor; ?> ctdvideo">
   <div class="list-group">
     <h3 class="tituloaula" style="margin:0;">
        <a href="#" class="list-group-item list-group-item-<?php echo $estiloCor; ?>"><i class="fa fa-youtube-play"></i> <?php echo $tituloAula1; ?></a>
     </h3>
   </div>
   <div class="panel-body">

     <?php
        if($descricaoaula != ''){
      ?>
     <div class="descricaoaula alert alert-<?php echo $estiloCor; ?>">
         <strong>Descrição da Aula:</strong> <?php echo $descricaoaula; ?>
     </div>
     <?php
      };
      ?>

     <div class="mostraVideo">
       <?php echo $CodigoVideo; ?>
     </div>

   </div>

   <div class="panel-footer antProx">
     <input type="hidden" class="moduloAltera" value="<?php echo $IDModuloAltera; ?>"/>
     <button class="btn btn-<?php echo $estiloCor; ?> btn-lg proxima Prox<?php echo $proximaAula; ?>"><i class="fa fa-forward"></i> Proxima Aula</a>
   </div>

 </div>
 </div>
 <!-- FIM  Coluna Video -->



 </div>
 </div>


<?php
};//Fim Se tiver aulas, executa o foreach

?>
