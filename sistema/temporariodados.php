<?php
/*


$capacidades = $_POST['idUsuario'];
$niveisdeacesso = $_POST['niveisdeacesso'];
$idModulo = $_POST['idModuloEnvia'];
$idAula =  $_POST['idAulaEnvia'];
//var_dump($capacidades);

//Pega o Botao do Banco
$pegaconfigbotao = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'configbotao' AND post_id = '$idModulo'");
if(count($pegaconfigbotao > 0)){
$listaconfigbotao = unserialize($pegaconfigbotao);

$monstratitulo =$listaconfigbotao['msgbotao'];
$monstralink =$listaconfigbotao['linkbotao'];
$monstratexto =$listaconfigbotao['textbotao'];

}else{

  $monstratitulo = 'Conteúdo Protegido. Para Acessa-lo adquira o Nosso treinamento clicando no botão abaixo:';
  $monstralink = '';
  $monstratexto = 'Quero Adquirir Agora';

}

$botaoNaoAutorizado = '<div class="msgfinal"><h1>'.$monstratitulo.'</h1></div>
<div class="linkfinal"><a href="'.$monstralink.'" class="bt_final" target="_blank">'.$monstratexto.'</a></div>';
//Finaliza Pega Botao
$nomeAula222 = $wpdb->get_var("SELECT meta_key FROM $wpdb->postmeta WHERE post_id = '$idModulo' AND meta_id = '$idAula'");

$nomeaulaex = explode('*', $nomeAula222);

$nomeAula22 = explode('aula',$nomeaulaex[1]);
$tituloAula = $nomeaulaex[2];
$idDaAula = $nomeAula22[1];
//var_dump($idDaAula);
$nomeAula = 'Aula '.$idDaAula.' - '.$tituloAula;
$pegaprotecaoaulas = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'gd_protecaoaulas' AND post_id = '$idModulo'");

$listaprotecao = unserialize($pegaprotecaoaulas);

$aulaatual = $listaprotecao['aula'.$idDaAula];
$nivelaluno = $aulaatual['nivelaluno'];
$pacotealuno = $aulaatual['pacotes'];

//var_dump($nivelaluno);
if($nivelaluno == 'subscriber'){
  $nivelaluno = 'optimizemember_level0';
}


if($capacidades != ''){
  $dadosUsuario = unserialize($capacidades);
  $niveisdeacesso = unserialize($niveisdeacesso);

$validaPacoteAdm = array_key_exists('administrator',$dadosUsuario);

$nivelAcessoAll = 'access_'.$nivelaluno;
$validaNivel = array_key_exists($nivelAcessoAll,$niveisdeacesso);

}
//var_dump($validaPacoteAcesso);

if($validaPacoteAdm == true){
$nivelaluno = 'publica';
}

//Faz Verificação somente se a aula for diferente de publica ou nao
if($nivelaluno != 'publica' && $nivelaluno != '' && $nivelaluno != 'nao'){
  //Verifica se o usuario está logado
  if ($capacidades != '') {
//$validaNivel = array_key_exists($nivelaluno,$dadosUsuario);

if($pacotealuno != ''){

  $lispacote = explode(',',$pacotealuno);
//  var_dump($lispacote);
  foreach($lispacote as $opacote){
    $nomePacote = 'access_optimizemember_ccap_'.$opacote;
    if(array_key_exists($nomePacote,$dadosUsuario)){
$validaPacote = true;
    }else{
      $validaPacote = false;
    }
  }

}else{
  $validaPacote = true;
}
  //var_dump($dadosUsuario);
  //var_dump($validaNivel);
  //$validaPacote = array_key_exists($nivelaluno,$dadosUsuario);
  if($validaPacote == true && $validaNivel == true ){
  //  var_dump($dadosUsuario);
  $codigovideoencoded = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE post_id = '$idModulo' AND meta_id = '$idAula'");
  $CodigoVideo = base64_decode($codigovideoencoded);
      //echo 'Aluno Autorizado';
  }else{

$CodigoVideo = $botaoNaoAutorizado;

};

  //var_dump($nivelaluno);

        }else{
  $CodigoVideo = $botaoNaoAutorizado;

  }//Fim verifica se o usuario está logado

//Retorna isso se a a aula for publica
}else{

  $codigovideoencoded = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE post_id = '$idModulo' AND meta_id = '$idAula'");
  $CodigoVideo = base64_decode($codigovideoencoded);

}


};
?>
<h2><?php echo $nomeAula; ?></h2>
<div class="videoFrame">
<?php echo $CodigoVideo;?>
</div>
*/
?>
 ?>
