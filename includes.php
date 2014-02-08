<?php
//Required files for the EOC Database Reader plugin.

$filepath = realpath (dirname(__FILE__));

include_once($filepath.'/settings.php');

include_once($filepath.'/admin/admin.php');

include_once($filepath.'/classes/query.php');
include_once($filepath.'/classes/recordset.php');



function eocdbr_register_stylesheet(){
    wp_register_style( 'eocdbr', plugins_url('css/eocdbr.css', __FILE__) );
    wp_enqueue_style( 'eocdbr' );
}
add_action( 'wp_enqueue_scripts', 'eocdbr_register_stylesheet' );

function eocdbr_register_jeditable(){
	wp_enqueue_script( 'jquery.dataTables', "http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/jquery.dataTables.js", array('jquery'));
	wp_enqueue_script( 'jquery.jeditable', "http://www.appelsiini.net/download/jquery.jeditable.mini.js", array('jquery'));
	wp_enqueue_script( 'jedit', plugins_url('js/jedit.js', __FILE__), array('jquery'));
}
add_action ( 'wp_enqueue_scripts', 'eocdbr_register_jeditable');

function eocdbr_register_javascript(){
	wp_enqueue_script( 'table', plugins_url('js/table.js', __FILE__), array('jquery'));
}

// Admin Page Functions
function eocdbr_plugin_admin_link($links) {
  $admin_link = '<a href="admin.php?page=eocdbr-admin">Settings</a>';
  array_unshift($links, $admin_link);
  return $links;
}
$plugin = plugin_basename($filepath.'/eoc-db-reader.php');
add_filter("plugin_action_links_$plugin", 'eocdbr_plugin_admin_link' );

// Front End Functions
function dbr_show_table($atts){
    extract(shortcode_atts(array('query_set_id' => 0), $atts));
    $query_type = 'SELECT';
    $query = new DBR_Query();
    $rc = new DBR_RecordSet();
    $rc->setQuery($query->get_query_string_by_id($query_set_id, $query_type));
    $rc->displayTable();
}
add_shortcode('dbr_show_table','dbr_show_table');

function dbr_show_form($atts){
    extract(shortcode_atts(array('query_set_id' => 0), $atts));
    $query_type = 'SELECT';
    $query = new DBR_Query();
    $rc = new DBR_RecordSet();
    $rc->setQuery($query->get_query_string_by_id($query_set_id, $query_type));
    $rc->displayForm();
}
add_shortcode('dbr_show_form','dbr_show_form');

?>

