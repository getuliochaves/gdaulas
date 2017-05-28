<div class="alert alert-success" style="clear:both; height:120px;">
<div class="form-group">
    <label for="inputText" class="col-sm-5 control-label">Escolha a Página que Deseja Adicionar Aulas:</label>    
    <div class="col-sm-7">
     <?php
     wp_dropdown_pages($args = array(
    'sort_order'   => 'ASC',
    'sort_column'  => 'post_title',
    'hierarchical' => 1,
    'post_type' => 'page'));	
	 ?>      
       <a class="btn btn-primary btn-large" style="margin-top:5px;" href="#" id="linkaddaulas">Adicionar Aulas a Esta Página</a>       
    </div>
  </div> 
</div>
<script>
$a = jQuery.noConflict();
$a(document).ready(function(){
	 $a("select#page_id").prepend("<option value='0'>Selecione uma Página:</option>");
  $a("select#page_id").val("0");	
	$a('#page_id').change(function(){
		var idpgaddaulas = $a('#page_id option:selected').val();
		var nomepgaddaulas = $a('#page_id option:selected').text();
		var montaLInkAulas = 'post.php?post='+ idpgaddaulas +'&action=edit&gd=admin#TB_inline?width=600&height=540&inlineId=modal_aulas_gdaulas';
		$a('#linkaddaulas').attr('href',montaLInkAulas);
		});
	
});
</script>