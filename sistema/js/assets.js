$a = jQuery.noConflict();

$a(document).ready(function(){

	linkPaginaDados = linkPaginaDados + '/wp-content/plugins/';
	linkPaginaDados = linkPaginaDados + 'gdaulas/sistema/pgdados.php';

		var mudaModulo = 'sim';
		var dadosmodulos = {IDModuloAltera : moduloInicial,  mudaModulo : mudaModulo, capacidades : capacidades, niveisdeacesso: niveisdeacesso, estiloCor:estiloCor, nkkkss: nkkkss}
$a('.mostraVideo').html('<div class="loading"><h4>Aguarde,Carregando Aula...</h4><br/><img src="'+loadingImg+'"/></div>');
		$a.ajax
					 ({

							 type: 'POST',
							 url: linkPaginaDados,
							 data: dadosmodulos,
							 timeout: 7000,
			 success: function(data){
							$a('.conteudoDados').html(data);
							var retornaP1 = $a('.pegaIdAula').first().attr('class');
							var primeiraAula = parseInt(retornaP1.match(/\d/g).join(''));
							$a('.'+primeiraAula).addClass('aulaSel');
							$a('.buletLi'+primeiraAula).addClass('aulaSel bgbulet');
						}
		});




    $a('.moduloscurso').live('click',function(){
			$a('.mostraVideo').html('<div class="loading"><h4>Aguarde,Carregando Aula...</h4><br/><img src="'+loadingImg+'"/></div>');
		var IDModuloAltera = $a(this).attr('id');
		var mudaModulo = 'sim';
		var dadosmodulos = {IDModuloAltera : IDModuloAltera,  mudaModulo : mudaModulo, capacidades : capacidades, niveisdeacesso: niveisdeacesso, estiloCor:estiloCor, nkkkss: nkkkss}
		$a.ajax
					 ({
							 type: 'POST',
							 url: linkPaginaDados,
							 data: dadosmodulos,
							 timeout: 7000,
			 success: function(data){
							$a('.conteudoDados').html(data);
								var retornaP1 = $a('.pegaIdAula').first().attr('class');
							var primeiraAula = parseInt(retornaP1.match(/\d/g).join(''));
							$a('.'+primeiraAula).addClass('aulaSel');
							$a('.buletLi'+primeiraAula).addClass('aulaSel bgbulet');
						}

						});

						setTimeout(function() {
								var alturaDivVideo = $a('.ctdvideo').height();
								var alturaMenuGeral = $a('.lsmodulos').height();
								if(alturaDivVideo < 50){
									alturaDivVideo = 400;
								}

								if(alturaMenuGeral > alturaDivVideo){
								var pct = 4.8*(alturaDivVideo / 100);
								alturaDivVideo = alturaDivVideo - pct;
								$a(".menuGeral").css({ "height": +alturaDivVideo+"px", "overflow": "auto"});
							};

						}, 600);

		});


    $a('.pegaIdAula, .proxima, .anterior').live('click',function(){

	var pegaClasses = $a(this).attr('class');
	var idList    = parseInt(pegaClasses.match(/\d/g).join(''));
	var idModulo = $a('.moduloAltera').val();

	$a('.pegaIdAula').removeClass('aulaSel');
	$a('.selecaoBI').removeClass('aulaSel bgbulet');

	$a('.'+idList).addClass('aulaSel');
	$a('.buletLi'+idList).addClass('aulaSel bgbulet');

	var mudaAula = 'sim';

$a('.mostraVideo').html('<div class="loading"><h4>Aguarde,Carregando Aula...</h4><br/><img src="'+loadingImg+'"/></div>');
	var dadosaula = {idList : idList,  idModulo : idModulo, mudaAula : mudaAula, capacidades : capacidades, niveisdeacesso: niveisdeacesso, estiloCor:estiloCor, nkkkss: nkkkss}
      $a.ajax
             ({
                 type: 'POST',
								 timeout: 7000,
                 url: linkPaginaDados,
                 data: dadosaula,
         success: function(data){
                $a('.conteudoVideo').html(data);
		 }
            });

						setTimeout(function() {
								var alturaDivVideo = $a('.ctdvideo').height();
								var alturaMenuGeral = $a('.lsmodulos').height();
								if(alturaDivVideo < 50){
									alturaDivVideo = 400;
								}

								if(alturaMenuGeral > alturaDivVideo){
								var pct = 4.8*(alturaDivVideo / 100);
								alturaDivVideo = alturaDivVideo - pct;
								$a(".menuGeral").css({ "height": +alturaDivVideo+"px", "overflow": "auto"});
							};

						}, 600);


});

$a('.moduloscurso:first-child').addClass('active');

$a('.moduloscurso').click(function(){
	$a('.moduloscurso').removeClass('active');
	$a(this).addClass('active');
});

$a('#submit').addClass('btn btn-primary btn-lg');
$a('#comment').attr('required', 'required');

setTimeout(function() {
		var alturaDivVideo = $a('.ctdvideo').height();
		var alturaMenuGeral = $a('.lsmodulos').height();
		if(alturaDivVideo < 50){
			alturaDivVideo = 400;
		}

		if(alturaMenuGeral > alturaDivVideo){
		var pct = 4.8*(alturaDivVideo / 100);
		alturaDivVideo = alturaDivVideo - pct;
		$a(".menuGeral").css({ "height": +alturaDivVideo+"px", "overflow": "auto"});
	};

}, 600);


});
