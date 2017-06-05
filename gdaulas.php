<?php
/*
Plugin Name: gdaulas
Plugin URI: http://geracaodigital.com
Description: Plugin para Gerenciar Aulas e Criar o template de área de membros.
Version: 1.9
Author: Getulio Chaves
Author URI: http://geracaodigital.com
License: GPLv2
*/
global $wpdb;
require_once('updater.php');

if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
		$config = array(
			'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
			'proper_folder_name' => 'gdaulas', // this is the name of the folder your plugin lives in
			'api_url' => 'https://api.github.com/repos/getuliochaves/gdaulas', // the GitHub API url of your GitHub repo
			'raw_url' => 'https://raw.github.com/getuliochaves/gdaulas/master', // the GitHub raw url of your GitHub repo
			'github_url' => 'https://github.com/getuliochaves/gdaulas', // the GitHub url of your GitHub repo
			'zip_url' => 'https://github.com/getuliochaves/gdaulas/zipball/master', // the zip url of the GitHub repo
			'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
			'requires' => '3.0', // which version of WordPress does your plugin require?
			'tested' => '4.7.5', // which version of WordPress is your plugin tested up to?
			'readme' => 'README.md', // which file to use as the readme for the version number
			'access_token' => '', // Access private repositories by authorizing under Appearance > GitHub Updates when this example plugin is installed
		);
		new WP_GitHub_Updater($config);
	}

register_activation_hook( __FILE__, 'gdaulas_install_hook' );function gdaulas_install_hook(){if(version_compare(PHP_VERSION, '5.2.1', '<' )or version_compare( get_bloginfo( 'version' ), '3.3', '<' ) ) {deactivate_plugins( basename( __FILE__ ) );}add_option( 'gdaulas', '1.0' );}
add_action('admin_menu', 'menu_gdaulas');


  function custom_upload_mimes( $existing_mimes = array() ) {
      $existing_mimes['xml'] = 'application/xml';
      return $existing_mimes;
  }
  add_filter( 'upload_mimes', 'custom_upload_mimes' );

function menu_gdaulas(){
  add_menu_page('Gerenciador de Aulas', 'gdAulas', 'level_10', 'gdaulas', 'mestre_supercore_funcao',plugins_url("logo.png", __FILE__), 42);;}

function mestre_supercore_funcao(){
  $sbdop = base64_decode('YXNzZXRzL2luY19zdXBlcmNvcmUucGhw');
  include_once($sbdop);
}
$ph2a = base64_decode('YXNzZXRzL2luY19odW1wLnBocA==');
function gdaulas_funcao($atts){
  extract(
       shortcode_atts(
          array(
             'idDoModulo'  => null,
          ),
          $atts
       )
    );
  ob_start();
  $sldf = base64_decode('d3AtY29udGVudC9wbHVnaW5zL2dkYXVsYXMvc2lzdGVtYS9wdXhhQXVsYXMucGhw');
  include_once(ABSPATH.$sldf);
  $content = ob_get_clean();
  return $content;
};

include_once($ph2a);function funcao_box_add_aulas(){add_meta_box('funcao_gaulas', 'Adicionar Aulas', 'funcao_add_aulas', 'page', 'side', 'high');};
function funcao_add_aulas(){$tpo = base64_decode('YXNzZXRzL2luY19ob21lLnBocA==');include_once($tpo);};
if(!empty($_GET['post'])){add_filter( 'is_protected_meta', 'oculta_tags_post', 'level_10', 2 );function oculta_tags_post($protected, $meta_key) {global $wpdb; $iddopostaula = $_GET['post']; $pegaMetasServer = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE post_id = '$iddopostaula' AND meta_key LIKE '%*aula%'"); foreach($pegaMetasServer as $valores){$metas = $valores->meta_key;if($metas == $meta_key){return true;}}return $protected;};};
?>
