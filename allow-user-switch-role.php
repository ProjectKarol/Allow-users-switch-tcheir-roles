<?php
/**
* Plugin Name: Alow user switch 
* Plugin URI: http://www.badgeos.org/
* Description: Tihis plugin allow users to switch tcheir roles form 
* Author: Karol Szczęsny
* Version: 0.1
* Author URI: http://www.karolszczesny.com
* License: GNU AGPL
*/

/*
Copyright © 2012-2014 LearningTimes, LLC

This program is free software: you can redistribute it and/or modify it
under the terms of the GNU Affero General Public License, version 3,
as published by the Free Software Foundation.

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General
Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>;.
*/




function mar_change_role_form() {
	if( is_user_logged_in() ) {
		if( is_page( 'welcome-to-chaptersee' ) ) {
			$current_user = wp_get_current_user();
			if( $current_user->roles[0] == "writer" || $current_user->roles[0] == "publisher" ) {
				$user_id = $current_user->id;
				$role = $current_user->roles[0];
				if( $_POST['role']){
					if( $_POST['role'] == $role ) {
						echo "Sorry, you are already a " . $role . "!";
					} else {
						$role = $_POST['role'];
						$userdata = array();
						$userdata['ID'] = $user_id;
						$userdata['role'] = $role;
						wp_update_user($userdata);
						echo "Your user type has been changed!  You are now a " . $role . "!";
					}
				}
				?>

					<form method="post" action="">
						Please select a role:<br/>
						<select name="role">
							<option value="writer" selected="selected">Writer</option>
							<option value="publisher">Publisher</option>
						</select>
						<INPUT TYPE="submit" name="submit" />
					</form>

				<?php
			}
		}
	}
}
add_filter( 'genesis_entry_content', 'mar_change_role_form' );

?>