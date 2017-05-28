<?php
global $wpdb;
$pastastyle = plugins_url().'/gdaulas/css/';
$pastajs = plugins_url().'/gdaulas/js/';
$raizsite = $_SERVER['DOCUMENT_ROOT'];
$pagePath = explode('wp-content', dirname(__FILE__));
$plugin_file = $pagePath[0].'/wp-content/plugins/gdaulas/gdaulas.php';
$dadosPlugin = get_plugin_data($plugin_file, $markup = true);
$pmPro = base64_decode('Z2RBdWxhcyAtIEdlcmVuY2lhZG9yIGRlIEF1bGFz');
$msAtc = base64_decode('QXRlbiZjY2VkaWw7JmF0aWxkZTtvOiBQYXJlY2VyIGhhdmVyIHVtIHByb2JsZW1hIGNvbSBzdWEgY2hhdmUgZGUgYXRpdmEmY2NlZGlsOyZhdGlsZGU7by4gQ2hhdmUgbiZhdGlsZGU7byBleGlzdGUgZW0gbm9zc28gc2Vydmlkb3Igb3UgZXN0JmFhY3V0ZTsgaW5jb3JyZXRhLiBWZXJpZmlxdWUgcGFyYSBxdWUgc2V1IHBsdWdpbiBuJmF0aWxkZTtvIHNlamEgYmxvcXVlYWRvLg==');
$versaoPlugin = $dadosPlugin['Version'];
$pg = $_GET['pg']; $pg2 = $_GET['pg2'];
$pg3 = $_GET['pg3']; $prodMetaId = $_GET['prodMetaId'];
$page = $_GET['page'];
?>
<link rel="stylesheet" href="<?php echo $pastastyle.'style.css' ?>" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<?php
if($sPMk != '0' && $sPMk == $totyCoy){
  include_once($t3cm);
}else{
  include_once($t2cm);
}
?>
