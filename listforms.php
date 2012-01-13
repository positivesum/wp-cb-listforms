<?php
require_once(ABSPATH . "/wp-content/plugins/gravityforms/forms_model.php");
if (!class_exists('cfct_module_listform')) {
	class cfct_module_listform extends cfct_build_module {
		
		/**
		 * Set up the module
		 */
		public function __construct() {
			$this->pluginDir		= basename(dirname(__FILE__));
			$this->pluginPath		= WP_PLUGIN_DIR . '/' . $this->pluginDir;
			$this->pluginUrl 		= WP_PLUGIN_URL.'/'.$this->pluginDir;	
			$opts = array(
				'description' => __('Display a form', 'carrington-build'),
				'icon' => $this->pluginUrl.'/icon.png'
			);
			
			// use if this module is to have no user configurable options
			// Will suppress the module edit button in the admin module display
			# $this->editable = false 
			
			parent::__construct('cfct-listform', __('Form', 'carrington-build'), $opts);
		}

		/**
		 * Display the module content in the Post-Content
		 * 
		 * @param array $data - saved module data
		 * @return array string HTML
		 */
		public function display($data) {
			$output=do_shortcode('[gravityform id='.$data['form_list'].']');
			echo $output;
		}

		/**
		 * Build the admin form
		 * 
		 * @param array $data - saved module data
		 * @return string HTML
		 */
		public function admin_form($data) {
			
			
			$forms = RGFormsModel::get_forms('1', "title");
				
			$output = '
			<div id="cfct-header-adv-options" class="cfct-post-layout-controls">
				<p>
					<label for="form_list">'.__('Display a form', 'carrington-build').'</label>
					<select name="form_list" id="form_list">
						';
						foreach ($forms as $form) {
							$output .= '
						<option value="'.$form->id.'" '.selected($form->id, $data['form_list'], false).'>'.$form->title.'</option>
							';
						}
						$output .= '
					</select> 
				</p>
			</div>
			'; 
			return $output;
		}
		/**
		 * Return a textual representation of this module.
		 *
		 * @param array $data - saved module data
		 * @return string text
		 */
		public function text($data) {
			$f=RGFormsModel::get_form($data['form_list']);
			return strip_tags($f->title);
		}
		
		
		/**
		 * Add custom css to the post/page admin
		 * OPTIONAL: omit this method if you're not using it
		 *
		 * @return string CSS
		 */
		public function admin_css() {
			return '';
		}
	}
	// register the module with Carrington Build
	cfct_build_register_module('cfct-listform', 'cfct_module_listform');
}
	