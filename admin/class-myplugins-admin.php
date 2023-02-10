<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/bagusalvin123
 * @since      1.0.0
 *
 * @package    Wp_Myplugins
 * @subpackage Wp_Myplugins/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Myplugins
 * @subpackage Wp_Myplugins/admin
 * @author     Bagus Alvin <bagusalvin224@gmail.com>
 */
use Carbon_Fields\Container;
use Carbon_Fields\Field;

class Wp_Myplugins_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $functions ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->functions = $functions;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Myplugins_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Myplugins_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-myplugins-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Myplugins_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Myplugins_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-myplugins-admin.js', array( 'jquery' ), $this->version, false );

	}

	function crb_attach_myplugins_options(){
		global $wpdb;

		$peta_myplugins = $this->functions->generatePage(array(
			'nama_page' => 'Peta Data Terpadu', 
			'content' => '[peta_myplugins]',
        	'show_header' => 0,
        	'update' => 1,
        	'no_key' => 1,
			'post_status' => 'publish'
		));

		$basic_options_container = Container::make( 'theme_options', __( 'MYPLUGINS Options' ) )
			->set_page_menu_position( 4 )
	        ->add_fields( array(
				Field::make( 'html', 'crb_myplugins_halaman_terkait' )
		        	->set_html( '
					<h5>HALAMAN TERKAIT</h5>
	            	<ol>
	            		<li><a target="_blank" href="'.$peta_myplugins['url'].'">'.$peta_myplugins['title'].'</a></li>
	            	</ol>
		        	' ),
	            Field::make( 'text', 'crb_apikey_myplugins', 'API KEY' )
	            	->set_default_value($this->functions->generateRandomString())
	            	->set_help_text('Wajib diisi. API KEY digunakan untuk integrasi data.')

            ) );

		Container::make( 'theme_options', __( 'Google Maps' ) )
			->set_page_parent( $basic_options_container )
			->add_fields( array(
	        	Field::make( 'map', 'crb_google_map_center_myplugins', 'Lokasi default Google Maps' ),
	        	Field::make( 'text', 'crb_google_api_myplugins', 'Google Maps APIKEY' )
	        		->set_default_value('AIzaSyDBrDSUIMFDIleLOFUUXf1wFVum9ae3lJ0')
	        		->set_help_text('Referensi untuk menampilkan google map <a href="https://developers.google.com/maps/documentation/javascript/examples/map-simple" target="blank">https://developers.google.com/maps/documentation/javascript/examples/map-simple</a>. Referensi untuk manajemen layer di Google Maps <a href="https://youtu.be/tAR63GBwk90" target="blank">https://youtu.be/tAR63GBwk90</a>'),
	        	Field::make( 'color', 'crb_warna_p3ke_myplugins', 'Warna garis P3KE' )
	        		->set_default_value('#00cc00'),
	        	Field::make( 'image', 'crb_icon_p3ke_myplugins', 'Icon keluarga P3KE' )
	        		->set_value_type('url')
        			->set_default_value(MYPLUGINS_PLUGIN_URL.'public/images/lokasi.png'),
	        	Field::make( 'color', 'crb_warna_stanting_myplugins', 'Warna garis stanting' )
	        		->set_default_value('#CC0003'),
	        	Field::make( 'image', 'crb_icon_stanting_myplugins', 'Icon anak stanting' )
	        		->set_value_type('url')
        			->set_default_value(MYPLUGINS_PLUGIN_URL.'public/images/lokasi.png'),
	        	Field::make( 'color', 'crb_warna_dtks_myplugins', 'Warna garis DTKS' )
	        		->set_default_value('#005ACC'),
	        	Field::make( 'image', 'crb_icon_dtks_myplugins', 'Icon dtks' )
	        		->set_value_type('url')
        			->set_default_value(MYPLUGINS_PLUGIN_URL.'public/images/lokasi.png')
	        ) );
	}

}