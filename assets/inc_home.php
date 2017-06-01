<a href="#TB_inline?width=600&height=540&inlineId=modal_aulas_gdaulas" class="thickbox button button-primary button-large">Gerenciador de Aulas</a>
<h3>Codigo deste Modulo</h3>
<?php
$idPost = $_GET['post'];
echo '[gdaulas idDoModulo='.$idPost.']';
?>
<!--Modal de conteudo -->
<div id="modal_aulas_gdaulas" style="display:none;">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<?php
global $wpdb;
$idPost = $_GET['post'];
$pgdados = plugins_url().'/gdaulas/dados.php';
?>
<script src="<?php echo plugins_url().'/gdaulas/js/base64.js'?>" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url().'/gdaulas/css/estilo.css'; ?>">


<div style="right:1px; bottom:1px; position:absolute; background:#ccc; padding:15px; display:none;" class="salvarprot">
<input type="submit" class="button button-primary button-large" value="Salvar Configurações" onClick="window.location.reload()"/>
</div>
<form class="formularioaulas" method="post" id="formularioaulas" action="<?php echo $pgdados; ?>" name="formularioaulas" id="formularioaulas">
<?php
$pegaaula = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key like '%*aula%' AND post_id = '$idPost' ORDER BY meta_key ASC");

$totalaulas = count($pegaaula);

if($totalaulas > 0){
foreach($pegaaula as $chaves => $vetores) {
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
}
ksort($novoArray);
}
//var_dump($novoArray);
?>
<!-- Inicio da Div Conteudo Fixo topo -->
<div class="menutopogdaulaslista">
<div class="botoesmenu">
<input type="button" class="button button-primary button-large btgerenciaraulas" value="Gerenciar Aulas" />
<input type="button" class="button button-primary button-large btconteudoprotegido" value="Configurar Conteúdo Protegido" />
<input type="button" class="button button-primary button-large btestilocor" value="Estilos de Cor" />
<input type="button" class="button button-primary button-large btexportarxml" value="Exportar Aulas" />
<input type="button" class="button button-primary button-large btimportarxmlgd" value="Importar Aulas" />
</div>

 <div class="protegertodasaulas">Alterar Todas as Aulas: <?php
      global $wp_roles;
	  $pega_options = get_option('ws_plugin__optimizemember_options');
	?>
      <select class="form-control" name="nivelprotegertodas" id="nivelprotegertodas">
      <option value="">Qual o nível do Aluno?</option>
       <option value="publica">Aula Pública</option>
      <?php
foreach($wp_roles->roles as $key=>$value){
	$retonarlevel2 = explode('_',$key);
	$retonarlevel = $retonarlevel2[1];
	//var_dump($retonarlevel2);
	if($retonarlevel != null){
		$pegalevel = $pega_options[$retonarlevel.'_label'];
		?>
		<option value="<?php echo $key; ?>"><?php echo $pegalevel; ?></option>
		<?php
	}else{
		?>
        <option value="<?php echo $key; ?>"><?php echo $value['name']; ?></option>
		<?php
		}

	}
?>
       </select>
    Pacotes:
    <input type="text" class="todospacotesop" placeholder="" value="" name="todospacotesop">
    <input type="button" class="button button-primary button-large" style="margin-right:5px;" value="Aplicar" id="addprotecao"/>
    </div>
</div><!-- Fim da Div Conteudo Fixo topo -->


<div class="addnovaaula" style="left:1px; bottom:1px; position:absolute; background:#ccc; padding:15px;">
<select name="server" class="server">
	<option value="vimeo">Vídeo do Vímeo</option>
    <option value="youtube">Vídeo do YouTube</option>
    <option value="outro">Outro Servidor</option>
</select>
<input type="text" class="idserver" placeholder="ID do Video" value="" name="idserver">
<input type="button" class="button button-primary button-large" style="margin-right:5px;" value="Adicionar Nova Aula" id="novaaula"/>
</div>
<!-- Inicio da Div ConteudoAulas -->
<div class="ctgerenciaraulas">

 <div class="recebedados"></div>
  <br>

<ul id="aulas">
<?php
if($totalaulas > 0){
	$conta = 1;
	$pegatodasasprotecoes = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'gd_protecaoaulas' AND post_id = '$idPost'");
	$arrayprotecao = unserialize($pegatodasasprotecoes);

	foreach($novoArray as $dadosaulas){


		$nomeaulafinal = $dadosaulas['tAula'];
		$classeaula = 'aula'.$dadosaulas['aula'];
		$numeroaula = $dadosaulas['aula'];
		$codigoAula1 = $dadosaulas['video'];
		$codigoAula = base64_decode($codigoAula1);

		$listaitensprotecao = $arrayprotecao[$classeaula];

    //var_dump($listaitensprotecao);

		$pacoteaula = $listaitensprotecao[pacotes];
		$nivelaula = $listaitensprotecao[nivelaluno];
    $descricaoaula1 = $listaitensprotecao[descricaoaula];
    $descricaoaula = base64_decode($descricaoaula1);

	?>






	<li id="<?php echo $numeroaula; ?>">
    <fieldset style="border:1px solid #999; padding:10px; margin-bottom:55px;">
  <legend><label class="aulas">Aula <?php echo $numeroaula; ?> - <span class="aquinomeaula<?php echo $numeroaula; ?>"><?php echo $nomeaulafinal; ?></span></label></legend>
  <input type="button" class="botaoexcluir excluiraulas" style="margin-right:5px;" value="X" id="<?php echo $numeroaula; ?>"/>



    <div>Proteger Aula: <?php
      global $wp_roles;
	  $pega_options = get_option('ws_plugin__optimizemember_options');

	?>
      <select class="form-control" name="peganivel<?php echo $numeroaula; ?>" id="peganivel<?php echo $numeroaula; ?>">
      <option <?php if($pacoteaula == ''){?> selected="selected" <?php };?> value="">Qual o nível do Aluno?</option>
       <option <?php if($nivelaula == 'publica'){?> selected="selected" <?php };?> value="publica">Aula Pública</option>
      <?php
foreach($wp_roles->roles as $key=>$value){
	$retonarlevel2 = explode('_',$key);
	$retonarlevel = $retonarlevel2[1];
	if($retonarlevel != null){
		$pegalevel = $pega_options[$retonarlevel.'_label'];
		?>
		<option <?php if($nivelaula ==  $key){?> selected="selected" <?php }; ?> value="<?php echo $key; ?>"><?php echo $pegalevel; ?></option>
		<?php
	}else{
		?>
        <option <?php if($nivelaula ==  $key){?> selected="selected" <?php }; ?> value="<?php echo $key; ?>"><?php echo $value['name']; ?></option>
		<?php
		}

	}
?>
       </select>
    Pacotes OptimizePress:
    <input type="text" style="width:200px;" class="pacotesop<?php echo $numeroaula; ?>" placeholder="Ex: pagmember,downloads" value="<?php echo $pacoteaula;?>" name="pacotesop<?php echo $numeroaula; ?>">

    </div>
    <input type="text" class="tituloaula aula<?php echo $numeroaula; ?>" required placeholder="Nome Aula <?php echo $numeroaula; ?>" value="<?php echo $nomeaulafinal; ?>" name="<?php echo $classeaula; ?>">
	<textarea class="codigoaula codigo<?php echo $numeroaula; ?>" placeholder="Código Aula <?php echo $numeroaula; ?>" name="codigo<?php echo $numeroaula; ?>"><?php echo $codigoAula; ?></textarea>
  <textarea class="descricaoaula descricao<?php echo $numeroaula; ?>" placeholder="Descrição da Aula <?php echo $numeroaula; ?>" name="descricao<?php echo $numeroaula; ?>"><?php echo $descricaoaula; ?></textarea>
	</li>
   </fieldset>
    <?php
	$conta++;
	}
	}
?>
 </ul>
  </form>
<?php
if($totalaulas == 0){
?>
<h1 style="text-align:center; margin-top:200px;">Este módulo ainda não possui nenhum aula.<br><br>Adicione aulas para Gerar sua Área de Membros.</h1>
<?php
};
 ?>

</div><!-- Fim da Div ConteudoAulas -->

<div class="exportaraulas">
  <div class="recebedados"></div>
  <input type="button" class="button button-primary button-large btexcluirarquivos" value="Excluir Arquivos Gerados" />
</div>



<!-- Inicio da Div importarxmlgd -->
<div class="importarxmlgd">

  <div class="form-group">
    <label for="inputText" class="col-sm-3 control-label">Arquivo XML GdAulas:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control arquivoxmlgd" placeholder="" value="" name="arquivoxmlgd">
	 <input class="arquivoXMLgdaulas button button-primary button-large" id="arquivoxmlgd" type="button" value="Selecionar Arquivo XML" />
   <input type="button" class="button button-primary button-large validarimportgd" value="Importar Dados" />
    </div>
  </div>

  <h3>Atenção: Ao Clicar em Importar Dados, todas as aulas existentes nesta pagina serão perdidas.</h3>

  <div class="recebedados"></div>

  <script>

jQuery(document).ready(function($){
    var custom_uploader;
    $('.arquivoXMLgdaulas').click(function(e) {
		classe = $(this).attr("id");
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Envie um Arquivo XML exportado de outras pagina GdAulas',
            button: {
                text: 'Usar este Arquivo'
            },
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('.'+ classe +'').val(attachment.url);
        });
        //Open the uploader dialog
        custom_uploader.open();
    });

});
</script>


</div>
<!-- Inicio da Div fim -->

<!-- Inicio da Div estilocor -->
<div class="estilocor">



  <fieldset style="border:1px solid #999; padding:10px; margin-bottom:55px;">
<legend><label><h3>Escolha um Estilo de Cor para esta Área de Membros</h3></label></legend>

<label>Selecionar Estilo: </label>
<select name="estiloCorArea" class="estiloCorArea">
  <option value="primary active">Azul Esculo</option>
  <option value="info active">Azul Claro</option>
  <option value="success active">Verde</option>
  <option value="danger active">Vermelho</option>
  <option value="warning active">Laranja</option>
  <option value="default active">Prateado</option>
</select>

<div class="recebedados"></div>


  </fieldset>




</div>
<!-- FIM da Div estilocor -->

<!-- Inicio da Div ConfigurarProtecao -->
<div class="ctconteudoprotegido">

  <?php
  $pegaconfigbotao = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'configbotao' AND post_id = '$idPost'");
  if(count($pegaconfigbotao > 0)){
  $listaconfigbotao = unserialize($pegaconfigbotao);

  $monstratitulo =$listaconfigbotao['msgbotao'];
  $monstralink =$listaconfigbotao['linkbotao'];
  $monstratexto =$listaconfigbotao['textbotao'];
  $destinobotao = $listaconfigbotao['destinobotao'];

  }else{

    $monstratitulo = 'Conteúdo Protegido. Para Acessa-lo adquira o Nosso treinamento clicando no botão abaixo:';
    $monstralink = '';
    $monstratexto = 'Quero Adquirir Agora';
	$destinobotao = '_self';

  }
  ?>


Mensagem de Aviso:<input type="text" class="campostexto msgbotao" required placeholder="Mensagem de Conteúdo Protegido" value="<?php echo $monstratitulo; ?>" name="msgbotao">
Texto Botão: <input type="text" class="campostexto textbotao" required placeholder="Texto que do Botão de Ação" value="<?php echo $monstratexto; ?>" name="textbotao">
Link Botão: <input type="text" class="campostexto linkbotao" required placeholder="Link para onde vai quando clicar" value="<?php echo $monstralink; ?>" name="linkbotao">
Destino: <select class="campostexto destinobotao" name="destinobotao">
	<option <?php if($destinobotao == '_self'){?> selected <?php }; ?> value="_self">Mesma Página</option>
	<option <?php if($destinobotao == '_blank'){?> selected <?php }; ?> value="_blank">Nova Página</option>
</select>

<div class="resultadosbotao">

<div class="msgfinal"><h1><spam class="msgtr"><?php echo $monstratitulo; ?></spam></h1></div>
<div class="linkfinal"><a href="<?php echo $monstralink; ?>" class="bt_final" target="<?php echo $destinobotao; ?>"><spam class="txttr"><?php echo $monstratexto; ?></spam></a></div>

</div>

</div><!-- Fim da Div ConfigurarProtecao -->



 <script>
var linkd = '<?php echo $pgdados; ?>';
var idPagina = '<?php echo $idPost; ?>';
 </script>
<script src="<?php echo plugins_url().'/gdaulas/js/validacao.js'?>" charset="utf-8"></script>

</div>
<!--Fim Modal de conteudo -->
