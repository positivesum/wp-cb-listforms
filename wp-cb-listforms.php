<?php
/*
Plugin Name: WPCB Form List
Plugin URI: 
Description: Provides Form CB Module that allows to add a from from Gravity Forms to a page
Version: 0.1
Author: Amit Singh
Author URI: http://amiworks.com
*/
if ( !class_exists( 'wp_cb_listforms' ) ) {
	class wp_cb_listforms {
		/**
		 * Initializes plugin variables and sets up wordpress hooks/actions.
		 *
		 * @return void
		 */
		function __construct( ) {
			$this->pluginDir		= basename(dirname(__FILE__));
			$this->pluginPath		= WP_PLUGIN_DIR . '/' . $this->pluginDir;
			add_action('cfct-modules-loaded',  array(&$this, 'wp_cb_listforms_load'));	
		}

		function wp_cb_listforms_load() {
			require_once($this->pluginPath . "/listforms.php");				
		}			
		
	}
	$wp_cb_listforms = new wp_cb_listforms();	
}
