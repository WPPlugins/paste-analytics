<?php
/**
 * Plugin Name: Paste Analytics
 * Plugin URI: http://www.wp-load-com
 * Description: Add Google Analytics script on your site
 * Version: 1.1
 * Author: Jens Törnell
 * Author URI: http://www.jenst.se
 * License: GPL2
 */

$pasteanalytics = new pasteanalytics();
class pasteanalytics {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'wp_head', array( $this, 'paste_script'), 100 );
		add_action( 'wp_footer', array( $this, 'footer_script' ) );
		add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( $this, 'action_links' ) );
	}

	function footer_script() {
		$count_wp_head_call = did_action('wp_head');
		if( $count_wp_head_call == 0 ) {
			$this->paste_script();
		}
	}

	function paste_script() {
		$options = get_option( 'pasteanalytics' );

		if( $options['active'] == 'inactive' ) {
			if( is_user_logged_in() ) {
				echo "<!--\n";
				echo "Paste Analytics is disabled for everyone!\n";
				echo "(Only logged users will see this comment)\n\n";
				echo $options['script'] . "\n";
				echo "-->\n";
			}
		} elseif( ! empty( $options['script'] ) ) {
			if( is_user_logged_in() ) {
				echo "<!--\n";
				echo "Paste Analytics is not running when you are logged in!\n";
				echo "(Only logged users will see this comment)\n\n";
				echo $options['script'] . "\n";
				echo "-->\n";
			} else {
				echo $options['script'];
			}
		}
	}

	function admin_menu() {
		add_options_page( 'Paste Analytics', 'Paste Analytics', 'manage_options', 'pasteanalytics', array( $this, 'options_page' ) );
	}

	function admin_init() {
		register_setting( 'pluginPage', 'pasteanalytics' );

		add_settings_section(
			'pasteanalytics_pluginPage_section',
			'',
			array( $this, 'section_html' ),
			'pluginPage'
		);

		add_settings_field(
			'script',
			__( 'Google Analytics script', 'pasteanalytics' ),
			array( $this, 'field_html_script' ),
			'pluginPage',
			'pasteanalytics_pluginPage_section'
		);

		add_settings_field(
			'active',
			__( 'Status', 'pasteanalytics' ),
			array( $this, 'field_html_active' ),
			'pluginPage',
			'pasteanalytics_pluginPage_section'
		);
	}

	function field_html_script() { 
		$options = get_option( 'pasteanalytics' );
		echo "<textarea class='large-text code' cols='40' rows='10' name='pasteanalytics[script]' placeholder='&lt;script&gt;\nGoogle Analytics\n&lt;/script&gt;'>";
		echo $options['script'];
	 	echo "</textarea>";
	 	echo "<em>Don't forget to include the <code>&lt;script&gt;</code> tags.</em>";
	}

	function field_html_active() { 
		$options = get_option( 'pasteanalytics' );
		?>
		<select name='pasteanalytics[active]'>
			<option value='' <?php selected( $options['active'], '' ); ?>>Active</option>
			<option value='inactive' <?php selected( $options['active'], 'inactive' ); ?>>Inactive</option>
		</select>
	<?php
	}

	function section_html() { }

	function options_page() { 
		?>
		<div class="wrap">
			<form action='options.php' method='post'>
				<h2>Paste Analytics</h2>
				<?php
				settings_fields( 'pluginPage' );
				do_settings_sections( 'pluginPage' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	function action_links( $links ) {
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=pasteanalytics' ) . '">Settings</a>',
		);
		return array_merge( $links, $settings_link );
	}
}
?>