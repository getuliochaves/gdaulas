<?php
global $wpdb;
include_once('definicoes.php');

$loadingImg = get_site_url().'/wp-content/plugins/gdaulas/imagens/loading.gif';

$idmddd = $idDoModuloEx[0];
$estiloCor = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'estiloCor' AND post_id = '$idmddd'");
if($estiloCor == '' or count($estiloCor) == 0){
	$estiloCor = 'primary active';
}
include_once('capacidades.php');
include_once('inclusoes.php');
?>
<!-- Inicio Conteudo Sistema -->
<div class="container-fluid">
<?php
if(count($idDoModuloEx) > 1){
?>

	<!-- Inicio Menu Modulos -->

	<div class="row">


		<nav class="navbar btn-<?php echo $estiloCor; ?> lsmenu">
  <div class="col-md-12">
    <div class="navbar-header">
			<span class="navbar-brand"><i class="fa fa-folder-open"></i></span>

    </div>
    <ul class="nav navbar-nav">


				<?php
					foreach ($idDoModuloEx as $idDoModuloCerto) {
					$pegaTituloModulo = $wpdb->get_var("SELECT post_title FROM $wpdb->posts WHERE ID = '$idDoModuloCerto'");
				?>
						<li class="moduloscurso" id="<?php echo $idDoModuloCerto; ?>">
							<a href="#"><?php echo $pegaTituloModulo; ?></a>
						</li>
				<?php
				};
				?>
			</ul>
		</div>
	</nav>
<?php
	};
?>

</div>
		<!-- FIM Menu Modulos -->

<br/>

<!-- Inicio Linha Aulas e Video -->
<div class="row">

	<!-- Inicio da Div Listagem de Aulas -->
	<div class="conteudoGeral">
		<div class="conteudoDados">

	    </div>
	</div><!-- Fim da Div Listagem de Aulas -->

	<!-- Inicio Coluna Comentarios -->
	<?php
	$pegaComentarios = $wpdb->get_var("SELECT comment_status FROM $wpdb->posts WHERE ID = '$idDoModulo'");
	if($pegaComentarios == 'open' && is_user_logged_in() != false ){
	?>


	<div class="col-md-9 pull-right">


		<div class="panel panel-<?php echo $estiloCor; ?> comentariosGeral" >

	    <div class="list-group">
	      <h3 class="tituloaula" style="margin:0;">
	         <a href="#" class="list-group-item list-group-item-<?php echo $estiloCor; ?>">
						 <i class="fa fa-comments-o"></i>
						 Comente a Aula, ou tire suas dúvidas
					 </a>
	      </h3>
		</div>
		<div class="panel-body">

			<div class="mostraComentario">
		        <div class="comentario">[comments]</div>
		   </div>
		</div>


	</div>
	</div>
	<!-- FIM  Coluna Comentarios -->

	<?php
	};
	?>


	</div>
<!-- FIM Linha Aulas e Video -->


<!-- FIM Conteudo Sistema -->

</div>

<script>
var linkPaginaDados = 	'<?php echo $pgdados;?>';
var moduloInicial = '<?php echo $idDoModuloEx[0]?>';
var capacidades = '<?php echo $capacidades; ?>';
var niveisdeacesso = '<?php echo $niveisdeacesso; ?>';
var estiloCor = '<?php echo $estiloCor; ?>';
var loadingImg = '<?php echo $loadingImg; ?>';


</script>
<script src="<?php echo $baseSistema.'js/assets.js'?>" charset="utf-8"></script>
