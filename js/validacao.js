$a = jQuery.noConflict();
$a(document).ready(function(){
	$a('.ctconteudoprotegido').hide();
	$a('.salvarprot').hide();
	$a('.estilocor').hide();
	$a('.importarxmlgd').hide();
	$a('.exportaraulas').hide();



	$a('.btgerenciaraulas').live('click',function(){
		$a('.ctgerenciaraulas').show();
		$a('.ctconteudoprotegido').hide();
		$a('.protegertodasaulas').show();
		$a('.addnovaaula').show();
		$a('.salvarprot').hide();
		$a('.estilocor').hide();
		$a('.importarxmlgd').hide();
		$a('.exportaraulas').hide();
		$a('.recebedados').html('');

	});

	$a(".btconteudoprotegido").live('click',function(){
		$a('.ctgerenciaraulas').hide();
		$a('.ctconteudoprotegido').show();
		$a('.protegertodasaulas').hide();
		$a('.addnovaaula').hide();
		$a('.salvarprot').show();
		$a('.estilocor').hide();
		$a('.importarxmlgd').hide();
		$a('.exportaraulas').hide();
		$a('.recebedados').html('');

	});




	$a('.btestilocor').live('click',function(){
		$a('.ctgerenciaraulas').hide();
		$a('.ctconteudoprotegido').hide();
		$a('.protegertodasaulas').hide();
		$a('.addnovaaula').hide();
		$a('.salvarprot').show();
		$a('.estilocor').show();
		$a('.importarxmlgd').hide();
		$a('.exportaraulas').hide();
		$a('.recebedados').html('');




	});

	$a('.btimportarxmlgd').live('click',function(){
		$a('.ctgerenciaraulas').hide();
		$a('.ctconteudoprotegido').hide();
		$a('.protegertodasaulas').hide();
		$a('.addnovaaula').hide();
		$a('.salvarprot').hide();
		$a('.estilocor').hide();
		$a('.exportaraulas').hide();
		$a('.importarxmlgd').show();
		$a('.recebedados').html('');
});

$a('.btexcluirarquivos').live('click',function(){

	var dados3 = 'enviarxml=nao&exluirarquivos=sim';
	$a.ajax({
		url: linkd,
		type: "POST",
		data: dados3,
		success: function(data){
		$a('.recebedados').html(data);
		//window.location = data;
		//$b(window.document.location).attr('href',novaURL);
		}
	});	//Fim do Ajax

});



$a('.btexportarxml').click(function(){
	$a('.ctgerenciaraulas').hide();
	$a('.ctconteudoprotegido').hide();
	$a('.protegertodasaulas').hide();
	$a('.addnovaaula').hide();
	$a('.salvarprot').hide();
	$a('.estilocor').hide();
	$a('.importarxmlgd').hide();
	$a('.exportaraulas').show();
	$a('.recebedados').html('');

	var dados2 = 'idPagina='+idPagina+'&enviarxml=sim';


	$a.ajax({
		url: linkd,
		type: "POST",
		data: dados2,
		success: function(data){
		$a('.recebedados').html(data);
		//window.location = data;
		//$b(window.document.location).attr('href',novaURL);
		}
	});	//Fim do Ajax



});






$a('.validarimportgd').live('click',function(){
	$a('.ctgerenciaraulas').hide();
	var arquivogd = $a('.arquivoxmlgd').val();
	novaURL = '';
var dados = 'arquivogd='+arquivogd+'&idPagina='+idPagina+'&importagd=sim&enviarxml=nao';
	$a.ajax({
		url: linkd,
		type: "POST",
		data: dados,
		success: function(data){
		$a('.recebedados').html(data);
		window.location.reload();
		}
	});	//Fim do Ajax


});


	$a('.estiloCorArea').live('keyup change',function(){
	var cor = $a('.estiloCorArea option:selected').val();
	//alert(cor);

	var dados = 'estiloCorArea='+cor+'&idPagina='+idPagina+'&gravaCor=sim&enviarxml=nao';

					$a.ajax({
						url: linkd,
						type: "POST",
						data: dados,
						success: function(data){
						$a('.recebedados').html(data);
						//$b(window.document.location).attr('href',novaURL);
						}
					});	//Fim do Ajax

		});


	$a("#novaaula").live('click',function(){


		var server = $a('.server option:selected').val();
		var idserver = $a('.idserver').val();

		if(idserver == ''){
			idserver = 'AQUI-VAI-O-CODIGO';
			}

		var codigoserver = '';
		if(server == 'vimeo'){
			codigoserver = '<iframe width="864" height="486" src="https://player.vimeo.com/video/'+ idserver +'" frameborder="0" allowfullscreen ></iframe>';
			}


		if(server == 'youtube'){
			codigoserver = '<iframe width="864" height="486" src="https://www.youtube.com/embed/'+ idserver +'?rel=0&showinfo=0" frameborder="0" allowfullscreen ></iframe>';
			}



		var ultimaLI = $a('ul#aulas li').length;
		ultimaLI = ultimaLI + 1;

		$a('.contaaulas').html(ultimaLI);

		for (i = 1; i < ultimaLI; i++) {
    		var itemCampo = $a('#aulas #'+i).attr('id');
			if(itemCampo == null){
				ultimaLI = i;
				}
		}



		$a('#aulas').append('<li id="'+ultimaLI+'"><fieldset style="border:1px solid #999; padding:10px; margin-bottom:20px;"><legend><label class="aulas">Aula '+ultimaLI+'</label></legend><input type="text" class="tituloaula aula'+ultimaLI+'" required placeholder="Nome Aula '+ultimaLI+'" value="" name="aula'+ultimaLI+'"><textarea class="codigoaula codigo'+ultimaLI+'" placeholder="Código Aula '+ultimaLI+'" name="codigo'+ultimaLI+'">'+ codigoserver +'</textarea></li><input type="button" class="button button-large excluiraulas" style="margin-right:5px;" value="Excluir Aula" id="'+ultimaLI+'"/></fieldset>');
	});

	$a('#addprotecao').live('click',function(){

		var niveltodosusu = $a('#nivelprotegertodas option:selected').val();
		var pacotestodos = $a('.todospacotesop').val();

		var protecao = 'niveldosalunos='+niveltodosusu+'&pacotedosalunos='+pacotestodos+'&idPagina='+idPagina+'&protecao=sim&enviarxml=nao';
		$a.ajax({
                url: linkd,
                type: "POST",
                data: protecao,
                success: function(data){
		$a('.recebedados').html(data);
		confirm('Alterações Realizadas, Clque em ok para Atualizar a Página');
		window.location.reload();
		//$b(window.document.location).attr('href',novaURL);
                }
            });	//Fim do Ajax

	});

	$a('#aulas li').live('keyup change',function(){
	var itemCampo = $a(this).attr('id');
	var dadosaula = $a('.aula'+itemCampo).val();
	var dadoscodigo = $a('.codigo'+itemCampo).val();
	var pegapacotes = $a('.pacotesop'+itemCampo).val();
	var peganivel =  $a('#peganivel'+itemCampo+' option:selected').val();

	var codigoServerEncode = $a.base64.encode(dadoscodigo);

	var dados = 'aula='+itemCampo+'&nomeaula='+dadosaula+'&codigovideo='+codigoServerEncode+'&idPagina='+idPagina+'&nivelaluno='+peganivel+'&pacotesop='+pegapacotes+'&modifica=sim&enviarxml=nao';
	$a('.aquinomeaula'+itemCampo).html(dadosaula);



            $a.ajax({
                url: linkd,
                type: "POST",
                data: dados,
                success: function(data){
		$a('.recebedados').html(data);
		//$b(window.document.location).attr('href',novaURL);
                }
            });	//Fim do Ajax
        });


//Ajax modifica botao
$a('.campostexto').live('keyup change',function(){
var linkbotao = $a('.linkbotao').val();
var textbotao = $a('.textbotao').val();
var msgbotao = $a('.msgbotao').val();

var destinobotao = $a('.destinobotao option:selected').val();

var msgfinal = '<h1>'+msgbotao+'</h1>';
var linkfinal = '<a class="" href="'+ linkbotao +'" class="botaofinal" target="'+destinobotao+'">'+textbotao+'</a>';

//var dadosdobotao = msgfinal + linkfinal;

$a('.msgtr').html(msgbotao);
$a('.txttr').html(textbotao);
$a('.bt_final').attr('href',linkbotao);
$a('.bt_final').attr('target',destinobotao);

var dadosbotaoconfig = 'linkbotao='+linkbotao+'&textbotao='+textbotao+'&destinobotao='+destinobotao+'&msgbotao='+msgbotao+'&idPagina='+idPagina+'&conteudobotao=sim&enviarxml=nao';
//$a('.aquinomeaula'+itemCampo).html(dadosaula);




					$a.ajax({
							url: linkd,
							type: "POST",
							data: dadosbotaoconfig,
							success: function(data){
//	$a('.resultadosbotao').html(data);
	//$b(window.document.location).attr('href',novaURL);
							}
					});	//Fim do Ajax


			});







		$a(".excluiraulas").live('click',function(){

		var removeli = $a('ul#aulas li').length;
		removeli = removeli - 1;


		$a('.contaaulas').html(removeli);

		var idAula = $a(this).attr('id');
		$a('#aulas #'+idAula).remove();
		var dados = 'aula='+idAula+'&remover=sim&enviarxml=nao&idPagina='+idPagina;

		$a.ajax({
                url: linkd,
                type: "POST",
                data: dados,
                success: function(data){
		$a('.recebedados').html(data);
		//$b(window.document.location).attr('href',novaURL);
                }
            });	//Fim do Ajax

	});


});
