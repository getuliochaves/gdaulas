<?php
if (is_user_logged_in() != false) {
	global $current_user;
	$current_user = wp_get_current_user();
	$user_info = get_userdata($current_user->ID);
	
	$idUsuarioLogado = $user_info->ID;
	
	$niveisdeacesso = $user_info->allcaps;
	$niveisdeacesso = serialize($niveisdeacesso);	
	
	$capacidades = $user_info->caps;
	$capacidades = serialize($capacidades);
		
}else{
	$capacidades = '';
	$niveisdeacesso = '';
}
 ?>
