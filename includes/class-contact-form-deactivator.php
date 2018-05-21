<?php

/**
 * Fired during plugin deactivation
 *
 * @link       naieem.me
 * @since      1.0.0
 *
 * @package    Contact_Form
 * @subpackage Contact_Form/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Contact_Form
 * @subpackage Contact_Form/includes
 * @author     Naieem Mahmud Supto <naieemsupto@gmail.com>
 */
class Contact_Form_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'contact_form';
		$sql = "DROP TABLE IF EXISTS $table_name";
		$wpdb->query($sql);
		delete_option("my_plugin_db_version");
	}

}
