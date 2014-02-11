<?php

	global $wpdb;
	// Grab the data from the $_POST request
	$table			= "wp_dbr_employee";
	$user_id		= 1;
	$key			= $_POST['id'];
	$value          = $_POST['value'];
	//$data			= array("'first_name' => '$value'");
	$data 			= $_POST;
	$where			= array('user_id' => $user_id);

	$result = ($wpdb->update( $table, $data, $where ) ? echo "UPD $value" : echo "Update Failed.";
?>
