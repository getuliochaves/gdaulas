<?php
global $wpdb;
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
  die();
delete_option( 'gdaulas' );
$deleta1 = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name = 'vd_gdaulas'");
$deleta3 = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name = 'sucessgd'");	
$deleta4 = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name = 'successgd'");	
