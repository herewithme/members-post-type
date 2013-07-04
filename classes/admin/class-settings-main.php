<?php
class MPT_Admin_Settings_Main {
	static $settings_api;
	static $id = 'mpt-main';

	/**
	 * __construct
	 *
	 * @access public
	 *
	 * @return mixed Value.
	 */
	public function __construct( ) {
		self::$settings_api = new WeDevs_Settings_API( );

		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );
		add_action( 'admin_init', array( __CLASS__, 'admin_init' ) );

		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_enqueue_scripts' ), 10, 1 );
	}

	/**
	 * admin_enqueue_scripts
	 *
	 * @param mixed $hook Description.
	 *
	 * @access public
	 * @static
	 *
	 * @return mixed Value.
	 */
	public static function admin_enqueue_scripts( $hook ) {
		if( $hook == 'settings_page_'.'mpt-settings' ) {
			wp_enqueue_script( MPT_CPT_NAME.'-admin-settings', MPT_URL.'assets/js/admin-settings.js', array( 'jquery' ), MPT_VERSION, true );
		}
	}

	/**
	 * admin_menu
	 *
	 * @param mixed $hook Description.
	 *
	 * @access public
	 * @static
	 *
	 * @return mixed Value.
	 */
	public static function admin_menu( ) {
		add_options_page( __( 'Members Post Type', 'mpt' ), __( 'Members Post Type', 'mpt' ), 'manage_options', 'mpt-settings', array( __CLASS__, 'render_page_settings' ) );
	}

	/**
	 * render_page_settings
	 *
	 * @access public
	 * @static
	 *
	 * @return mixed Value.
	 */
	public static function render_page_settings( ) {
		include (MPT_DIR.'views/admin/page-settings.php');
	}

	/**
	 * admin_init
	 *
	 * @access public
	 * @static
	 *
	 * @return mixed Value.
	 */
	public static function admin_init( ) {
		//set the settings
		self::$settings_api->set_sections( self::get_settings_sections( ) );
		self::$settings_api->set_fields( self::get_settings_fields( ) );

		//initialize settings
		self::$settings_api->admin_init( );
	}

	public static function get_settings_sections( ) {
		$sections = array(
			array(
				'id' => 'mpt-main',
				'tab_label' => __( 'General', 'mpt' ),
				'title' => __( 'Features available', 'mpt' ),
				'desc' => false,
			),
			array(
				'id' => 'mpt-pages',
				'tab_label' => __( 'Feature Pages', 'mpt' ),
				'title' => __( 'Feature Pages', 'mpt' ),
				'desc' => __( 'You must define here the pages containing the WordPress shortcodes for different features (login, registration, etc).', 'mpt' ),
			),
			array(
				'id' => 'mpt-security',
				'tab_label' => __( 'Security', 'mpt' ),
				'title' => __( 'Password strength', 'mpt' ),
				'desc' => __( 'Enforce a specific password strength for your members.', 'mpt' ),
			),
			array(
				'id' => 'mpt-emails',
				'tab_label' => __( 'Mails', 'mpt' ),
				'title' => __( 'Admin mail for Member registration', 'mpt' ),
				'desc' => __( 'Management of mail notification to the site administrator when a new member joins the site.', 'mpt' ),
			)
		);
		return $sections;
	}

	/**
	 * Returns all the settings fields
	 *
	 * @return array settings fields
	 */
	public static function get_settings_fields( ) {
		$settings_fields = (array) include( MPT_DIR . 'classes/helpers/options-default.php' );
		return $settings_fields;
	}

	/**
	 * TODO: Keep logic
	 *
	 * @param mixed $input Description.
	 *
	 * @access public
	 * @static
	 *
	 * @return mixed Value.
	 */
	public static function validate_input( $input ) {
		// Cleanup input
		$input = stripslashes_deep( $input );

		// Create our array for storing the validated options
		$output = array( );

		// Loop through each of the incoming options
		foreach( self::get_default_options() as $key => $value ) {
			if( isset( $input[$key] ) ) {
				$output[$key] = strip_tags( $input[$key] );
				// TODO : Remove striptags depending fields
			} else {
				$output[$key] = 0;
			}
		}

		// Constraint & Signon
		if( (int)$output['allow-signon-email'] == 1 ) {
			$output['unique-email'] = 1;
		}

		// Return the array processing any additional functions filtered by this action
		return apply_filters( 'mpt_settings_validate_input', $output, $input, self::$id );
	}

}