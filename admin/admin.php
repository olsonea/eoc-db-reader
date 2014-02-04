<?php
/***************************************************************************


        EOC Database Reader
        Author: Eric Olson Consulting LLC
        Website: www.ericolsonconsulting.com
        Contact: http://www.ericolsonconsulting.com

        This file is part of EOC Database Reader.

    EOC Database Reader is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    EOC Database Reader is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with EOC Database Reader; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
        
        You can find a copy of the GPL licence here:
        http://www.gnu.org/licenses/gpl-3.0.html
        
******************************************************************************/
$filepath = realpath (dirname(dirname(__FILE__)));
include_once($filepath.'/includes.php');

function eocdbr_add_plugins_page(){
    $page_title =  'EOC Database Reader';
    $menu_title = 'EOC Database Reader';
    $capability = 'manage_options';
    $menu_slug = 'eocdbr-admin';
    $function = 'eocdbr_admin_page';
    $icon_url = plugin_dir_url( __FILE__ ).'images/eocdbr.png';
    
    $my_page = add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url);
    add_action( 'load-' . $my_page, 'load_admin_css' );    
}
add_action( 'admin_menu','eocdbr_add_plugins_page');

function load_admin_css(){
	add_action( 'admin_enqueue_scripts', 'enqueue_admin_css' );
}

function enqueue_admin_css($page) {
	$admin_css = plugins_url('/css/eocdbr-admin.css',__FILE__);
	wp_enqueue_style('eocdbr-admin', $admin_css);
}


function eocdbr_admin_page(){ ?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2>EOC Database Reader Setting</h2>
        <form method="post" action="options.php"> 
            <?php settings_fields( 'default' ); ?>
            <h3>Database Query Configuration</h3>
                <p>This settings page allows you to enter a valid mysql database query. This is the query that will be executed by the plugin.</p>
                <table class="eocdbr">
                <?php
                    $results  = dbr_list_tables();
                    dbr_table_select_options($results);
                ?>
                	<tr>
						<th class="eocdbr"><label class="eocdbr" for="eocdbr_query">Query: </label></th>
						<td class="eocdbr"><input class="eocdbr" type="text" id="eocdbr_query" name="eocdbr_query" value="<?php echo get_option('eocdbr_query'); ?>" /></td>
					</tr>					
                </table>
            <?php submit_button(); ?>
        </form>
        <?php
			$query_set_id = 1;
			$query_type = 'SELECT';
			$query = new DBR_Query();
			$rc = new DBR_RecordSet();
			$rc->setQuery($query->get_query_string_by_id($query_set_id, $query_type));
			$rc->displayTable();
        ?>
    </div>
<?php
}

function dbr_list_tables(){
        global $wpdb;
        $query = 'show tables;';
        $results = $wpdb->get_results($query,ARRAY_A);
    return $results;
}

function dbr_table_select_options($results) {
    if(count($results) == 0) {
         echo '<em>No rows returned</em>';
    } else {
		echo '<tr><th class="eocdbr"><label class="eocdbr" for="eocdbr_table">Select Table: </label></th><td class="eocdbr"><select id="eocdbr_tables" name="eocdbr_tables">'."\n";
        foreach($results as $result) {
                echo '<option value="'.implode('">', array_values($result)).'">'.implode('</option>',array_values($result)).'</option>';
        }
        echo '</select></td></tr><br />';
    }
}

?>
