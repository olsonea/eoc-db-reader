<?php

function writeValue(){
	$global $wpdb
	$rawdata    = $_POST;
	
	// Grab the data from the $_POST request
	$table			= "wp_dbr_employee";
	$user_id		= 1;
	$value          = $rawdata['value'];
	$key        	= $rawdata['column'];
	$data			= array("'$key' => '$value'");
	$where			= array("'user_id' = $user_id");

	$result = $wpdb->update( $table, $data, $where );

	// Provide feedback to the entry field
	if (!$result) { echo "Update failed"; }
	else          { echo "UPD: $value"; }
}
add_action('wp_ajax_writeValue', 'writeValue');
?>
