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

function dbr_show_results(){
	global $wpdb;
	$query = get_option('eocdbr_query');
	$results = $wpdb->get_results($query,ARRAY_A);
	echo "Query: '$query'<br />";
	dbr_queryResultAsTable($results);
}

add_shortcode('dbr_show_results','dbr_show_results');

function dbr_queryResultAsTable($results) {
    if(count($results) == 0) {
        echo '<em>No rows returned</em>';
    } else {
	echo '<table><thead><tr><th class="eocdbr">'.implode('</th><th class="eocdbr">', array_keys(reset($results))).'</th></tr></thead><tbody>'."\n";
        foreach($results as $result) {
        	echo '<tr><td>'.implode('</td><td>', array_values($result)).'</td></tr>'."\n";
        }

        echo '</tbody></table>';
    }
}


// Add settings link on plugin page
function eocdbr_plugin_admin_link($links) {
  $admin_link = '<a href="admin.php?page=eocdbr-admin">Settings</a>';
  array_unshift($links, $admin_link);
  return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'eocdbr_plugin_admin_link' );

?>

