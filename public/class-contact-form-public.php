<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       naieem.me
 * @since      1.0.0
 *
 * @package    Contact_Form
 * @subpackage Contact_Form/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Contact_Form
 * @subpackage Contact_Form/public
 * @author     Naieem Mahmud Supto <naieemsupto@gmail.com>
 */
class Contact_Form_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Contact_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Contact_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/contact-form-public.css', array(), $this->version, 'all');

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Contact_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Contact_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/contact-form-public.js', array('jquery'), $this->version, false);

	}

	/**
	 * Register storing contact form information
	 *
	 * @since    1.0.0
	 */
	public function store_contact_form_info() {

		global $wpdb;
		$options = get_option('gamiphy_settings');
		// echo json_encode($_POST);
		$email = $_POST['email'];
		$name = $_POST['name'];
		$subject = $_POST['subject'];
		if ($email !== '' && $name !== '' && $subject !== '') {
			$table = $wpdb->prefix . 'contact_form';
			$data = array('email' => $email, 'name' => $name, 'subject' => $subject);
			$format = array('%s', '%s', '%s');
			$wpdb->insert($table, $data, $format);
			$id = $wpdb->insert_id;
			if ($id) {
				echo json_encode(array(
					'status' => true,
					'message' => $options['contact_form_request_success'],
				));
			} else {
				echo json_encode(array(
					'status' => false,
					'message' => $wpdb->last_error,
				));
			}
		} else {
			echo json_encode(array(
				'status' => false,
				'message' => $options['contact_form_request_error'],
			));
		}
		die();

	}

}
