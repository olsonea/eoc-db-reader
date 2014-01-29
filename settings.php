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


function eocdbr_register_settings(){
	add_option( 'eocdbr_query', '');

	register_setting( 'default', 'eocdbr_query' );
}
add_action( 'admin_init', 'eocdbr_register_settings' );

function eocdbr_add_plugins_page(){
	add_plugins_page('EOC Database Reader', 'EOC Database Reader', 'manage_options', 'eocdbr-options', 'eocdbr_options_page');
}
add_action( 'admin_menu','eocdbr_add_plugins_page');

function eocdbr_options_page(){ ?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2>EOC Database Reader Setting</h2>
		<form method="post" action="options.php"> 
			<?php settings_fields( 'default' ); ?>
			<h3>Database Query Configuration</h3>
				<p>This settings page allows you to enter a valid mysql database query. This is the query that will be executed by the plugin.</p>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label for="eocdbr_query">Query: </label></th>
						<td><input class="regular-text" type="text" id="eocdbr_query" name="eocdbr_query" value="<?php echo get_option('eocdbr_query'); ?>" /></td>
					</tr>
				</table>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}

?>
