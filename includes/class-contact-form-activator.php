<?php

/**
 * Fired during plugin activation
 *
 * @link       naieem.me
 * @since      1.0.0
 *
 * @package    Contact_Form
 * @subpackage Contact_Form/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Contact_Form
 * @subpackage Contact_Form/includes
 * @author     Naieem Mahmud Supto <naieemsupto@gmail.com>
 */
class Contact_Form_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'contact_form';

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
		    id mediumint(9) NOT NULL AUTO_INCREMENT,
		    name varchar(255) not null,
		    email varchar(255) not null,
		    subject text not null,
		    created_date  timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
		    UNIQUE KEY id (id)
		) $charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta($sql);
	}

}
