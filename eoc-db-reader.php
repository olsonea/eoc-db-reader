<?php
/*
Plugin Name: EOC Database Reader
Plugin URI: http://www.ericolsonconsulting.com
Description: EOC Database Reader is an exercise in retrieving records from a database query.
Version: 0.0.1
Author: Eric Olson Consulting LLC
Author URI: http://www.ericolsonconsulting.com
License: GPL3
*/
$filepath = realpath (dirname(__FILE__));
include_once($filepath.'/includes.php');

function dbr_show_results($atts){
    extract(shortcode_atts(array('query_id' => 0), $atts));
    $query = new DBR_Query();
    $rc = new DBR_RecordSet();
    $rc->setQuery($query->get_query_string_by_id($query_id));
    $rc->displayTable();
}

add_shortcode('dbr_show_results','dbr_show_results');

// Add settings link on plugin page
function eocdbr_plugin_admin_link($links) {
  $admin_link = '<a href="admin.php?page=eocdbr-admin">Settings</a>';
  array_unshift($links, $admin_link);
  return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'eocdbr_plugin_admin_link' );

?>

