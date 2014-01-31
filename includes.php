<?php
//Required files for the EOC Database Reader plugin.

$filepath = realpath (dirname(__FILE__));

include_once($filepath.'/settings.php');

include_once($filepath.'/admin/admin.php');

include_once($filepath.'/classes/query.php');
include_once($filepath.'/classes/recordset.php');

add_action( 'wp_enqueue_scripts', 'eocdbr_register_stylesheet' );

function eocdbr_register_stylesheet(){
    wp_register_style( 'prefix-style', plugins_url('css/eocdbr.css', __FILE__) );
    wp_enqueue_style( 'prefix-style' );
    //include_once($filepath.'/css/eocdbr.css');
}

?>

