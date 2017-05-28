var idUsuario = '<?php echo $idUsuario; ?>';
var niveisdeacesso = '<?php echo $niveisdeacesso; ?>';
var primeiroID = $a('.PegaPrimeiroID').val();
$a('#'+primeiroID).addClass('aulaSel');
$a('.'+primeiroID).addClass('buletLi2');
var pegaClassesZero = $a('#'+primeiroID).attr("class");
var idListZero    = parseInt(pegaClassesZero.match(/\d/g).join(''));
var aulaProximaZero = idListZero + 1;
var idProxZero = $a('.'+aulaProximaZero).attr("id");
$a('.proxima').attr("id",idProxZero);
$a('.anterior').hide();

var idModulo = $a('.idModuloAtual').val();
var dadosinicial = {idAulaEnvia : primeiroID,  idModuloEnvia : idModulo, idUsuario : idUsuario, niveisdeacesso : niveisdeacesso}
$a.ajax
   ({
       type: 'POST',
       url: '<?php echo $pgdados;?>',
       data: dadosinicial,
success: function(data){
      $a('.mostraVideo').html(data);
    }
    });


$a('.pegaIdAula, .proxima, .anterior').live('click',function(){

 var idAula = $a(this).attr("id");
var pegaClasses = $a('#'+idAula).attr("class");
$a('.pegaIdAula').removeClass('aulaSel');
$a('.buletLi').removeClass('buletLi2');
$a('#'+idAula).addClass('aulaSel');
$a('.'+idAula).addClass('buletLi2');
var idList    = parseInt(pegaClasses.match(/\d/g).join(''));
var aulaAnterior = idList - 1;
var idAnt = $a('.'+aulaAnterior).attr("id");
var pegaAntID = $a('#'+idAnt).text();
var aulaProxima = idList + 1;
var idProx = $a('.'+aulaProxima).attr("id");
var pegaPxID = $a('#'+idProx).text();


 var dados = {idAulaEnvia : idAula,  idModuloEnvia : idModulo, idUsuario : idUsuario, niveisdeacesso : niveisdeacesso}
 $a.ajax
        ({
            type: 'POST',
            url: '<?php echo $pgdados;?>',
            data: dados,
    success: function(data){
           $a('.mostraVideo').html(data);
      if(pegaAntID != ''){
     $a('.anterior').attr("id",idAnt);
     var iditem1 = $a('.anterior').attr("id");
     $a('.anterior').show();
     }else{
    $a('.anterior').hide();
       }
     if(pegaPxID != ''){
     $a('.proxima').attr("id",idProx);
     var iditem = $a('.proxima').attr("id");
     $a('.proxima').show();
     }else{
    $a('.proxima').hide();
       }
     }
  });
});
