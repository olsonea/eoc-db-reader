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
	//$query = $wpdb->prepare('select ID, user_login, user_email from wp_users order by ID asc;');
	//$query = 'select ID, user_login, user_email from wp_users order by ID asc;'; 
	//$query = 'select option_id, option_name from wp_options order by option_id asc;';
		//$query doesn't need to be prepared because it has no inputs.
	//$query = 'show tables;';
	//$query = 'describe wp_comments;';
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
	echo '<table><thead><tr><th>'.implode('</th><th>', array_keys(reset($results))).'</th></tr></thead><tbody>'."\n";
        foreach($results as $result) {
        	echo '<tr><td>'.implode('</td><td>', array_values($result)).'</td></tr>'."\n";
        }

        echo '</tbody></table>';
    }
}


// Add settings link on plugin page
function eocdbr_plugin_settings_link($links) {
  $settings_link = '<a href="plugins.php?page=eocdbr-options">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'eocdbr_plugin_settings_link' );

?>

