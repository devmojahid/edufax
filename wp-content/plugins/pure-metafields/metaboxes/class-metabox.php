<?php


/**
 * Register a meta box using a class.
 */
class tpmeta_meta_box {

	private static $instance = false;

	/**
	 * Constructor.
	 */
	public function __construct() {
		
		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'tpmeta_init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'tpmeta_init_metabox' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'tpmeta_load_metabox_scripts') );
		}
		
	}

	/**
	 * Load css and js 
	 */
	public function tpmeta_load_metabox_scripts(){
		// css
		wp_enqueue_style( 'wp-color-picker');
		wp_enqueue_style( 'jquery-ui', TPMETA_URL . 'metaboxes/css/jquery-ui.min.css', array(), time(), 'all');
		wp_enqueue_style( 'select2', TPMETA_URL . 'metaboxes/css/select2.min.css', array(), time(), 'all');
		wp_enqueue_style( 'tm-metabox-css', TPMETA_URL . 'metaboxes/css/style.css', array(),  time(), 'all');


		//js
		wp_enqueue_script( 'select2',  TPMETA_URL . 'metaboxes/js/select2.min.js',    array('jquery'), time(), true);
		wp_enqueue_script( 'wp-color-picker');
		wp_enqueue_script( 'tm-metabox-js',  TPMETA_URL . 'metaboxes/js/main.js',    array('jquery', 'jquery-ui-datepicker'), time(), true);
		wp_enqueue_script( 'repeater',  TPMETA_URL . 'metaboxes/js/repeater.js',    array('jquery', 'jquery-ui-datepicker'), time(), true);

	
		wp_enqueue_media();
	}

	/**
	 * Meta box initialization.
	 */
	public function tpmeta_init_metabox() {
		add_action( 'add_meta_boxes', array( $this, 'tpmeta_add_metabox'  ) );
		add_action( 'save_post', array( $this, 'tpmeta_save_metabox' ), 10, 2 );
	}

	/**
	 * Adds the meta box.
	 */
	public function tpmeta_add_metabox() {
		$metaboxs =  apply_filters('tp_meta_boxes', array());
		if(!empty($metaboxs)){
			foreach($metaboxs as $metabox){
				$_post_format = get_post_format();
				if( isset($metabox['post_format']) ){
					if($_post_format == $metabox['post_format']){
						$this->tpmeta_metabox_action($metabox, "remove");
					}else{
						$this->tpmeta_metabox_action($metabox);
					}
				}
				add_meta_box(
					$metabox['metabox_id'],
					$metabox['title'],
					array($this, 'tpmeta_metabox_render'),
					$metabox['post_type'],
					$metabox['context'],
					$metabox['priority'],
					array('meta' => $metabox)
				);
			}
		}
	}

	/**
	 * Hide Metabox
	 */
	public function tpmeta_metabox_action( $metabox, $action = NULL ){
		$screen_id 	= get_current_screen()->id;
		$user_id 	= get_current_user_id();
		$defaults 	= array(
			'postexcerpt',
			'trackbacksdiv',
			'postcustom',
			'commentstatusdiv',
			'commentsdiv',
			'slugdiv',
			'authordiv',
		);
		$closed_meta_boxes = get_user_meta($user_id, 'metaboxhidden_' . $screen_id, true);

		if($action == "remove"){
			if(empty($closed_meta_boxes)){
				return;
			}
			$search = array_search($metabox['metabox_id'], $closed_meta_boxes);
			
			if( !is_bool($search) && $search >= 0){
				unset($closed_meta_boxes[$search]);
			}
			update_user_meta($user_id, 'metaboxhidden_' . $screen_id, $closed_meta_boxes);
		}else{
			if( empty($closed_meta_boxes) ){
				$defaults[] = $metabox['metabox_id'];
				update_user_meta($user_id, 'metaboxhidden_' . $screen_id, $defaults);
			}else{
				$search = array_search($metabox['metabox_id'], $closed_meta_boxes);
				if(is_bool($search) && $search == false ){
					$closed_meta_boxes[] = $metabox['metabox_id'];
					update_user_meta($user_id, 'metaboxhidden_' . $screen_id, $closed_meta_boxes);
				}else{
					update_user_meta($user_id, 'metaboxhidden_' . $screen_id, $closed_meta_boxes);
				}
			}
		}
	}

	/**
	 * Metabox HTML Render Funtion
	 */
	public function tpmeta_metabox_render($post, $metabox){
		$meta = $metabox['args']['meta'];
		ob_start();?>
		<div class="tm-meta-wrapper">
			<?php wp_nonce_field( "_nonce_action_tp_metabox", "_nonce_tp_metabox" ); ?>
			<input type="hidden" name="current_metabox_id[]" value="<?php echo esc_attr($meta['metabox_id']); ?>">
			<?php 
				foreach($meta['fields'] as $field){
					tpmeta_load_template('metaboxes/fields/group.php', array(
						'field' 	=> $field,
						'fields' 	=> $meta['fields'],
					));
				}
			?>
		</div>
		
		<?php if(isset($meta['post_format']) && $meta['post_format'] != ""): ?>
		<script type="text/javascript">
			(function( $, document ){
				"use scrict";
				$(document).ready(function(){
					if(wp.data == undefined){
						$('#post-formats-select input[name="post_format"]').on('change', function(){
							if($(this).val() == '<?php echo esc_html($meta['post_format']); ?>'){
								$('#<?php echo esc_html(esc_html($meta['metabox_id'])); ?>').show()
							}else{
								$('#<?php echo esc_html(esc_html($meta['metabox_id'])); ?>').hide()
							}
						})
					}else{
						wp.data.subscribe( function () {
							var getFormat = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'format' )
							if(getFormat == '<?php echo esc_html($meta['post_format']); ?>'){
								$('#<?php echo esc_html(esc_html($meta['metabox_id'])); ?>').show()
							}else{
								$('#<?php echo esc_html(esc_html($meta['metabox_id'])); ?>').hide()
							}
						})
					}
					
				})
			})( jQuery )
		</script>
		<?php endif; ?>
		<?php
		echo ob_get_clean();
	}

	/**
	 * Handles saving the meta box.
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post    Post object.
	 * @return null
	 */
	public function tpmeta_save_metabox( $post_id, $post ) {
		
		// Add nonce for security and authentication.
		$metaboxes = apply_filters('tp_meta_boxes', array());

		// check if empty
		if(!isset($_POST['_nonce_tp_metabox'])){
			return;
		}

		// Check if nonce is valid.
		if ( !wp_verify_nonce( $_POST['_nonce_tp_metabox'], '_nonce_action_tp_metabox' ) ) {
			return;
		}

		// Check if user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Check if not an autosave.
		if ( wp_is_post_autosave( $post_id ) ) {
			return;
		}

		// Check if not a revision.
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		$current_meta = array_filter($metaboxes, function($item){
			if( is_array($_POST['current_metabox_id']) ){
				if(in_array($item['metabox_id'], $_POST['current_metabox_id'])){
					return $item;
				}
			}else{
				return $item['metabox_id'] == $_POST['current_metabox_id'];
			}
		});

		$current_metas = array_values($current_meta);
		$types = array('text', 'image', 'gallery', 'colorpicker', 'tabs', 'select', 'datepicker', 'select_posts');

		foreach($current_metas as $meta){
			$fields = $meta['fields'];
		
			foreach($fields as $field){
				
				if(in_array($field['type'], $types) && !empty($_POST[$field['id']])){
					update_post_meta($post_id, $field['id'], sanitize_text_field($_POST[$field['id']]));
				}elseif($field['type'] == 'textarea' && !empty($_POST[$field['id']])){
					update_post_meta($post_id, $field['id'], sanitize_textarea_field($_POST[$field['id']]));
				}elseif($field['type'] == 'repeater' && isset($_POST[$field['id']]) ){
					$_meta_key = $field['id'];
					$_repeater_rows = self::sanitize_array($_POST[$field['id']]);
					$_repeater_rows_value = array();
					for($i=0; $i<count($_repeater_rows); $i++){
						$_row = array();
						foreach( $field['fields'] as $repeater_field ){
							$_get_field_value = self::sanitize_array($_POST[$repeater_field['id']]);
							if(in_array($repeater_field['type'], $types) && !empty($repeater_field)){
								$_row[$repeater_field['id']] = sanitize_text_field($_get_field_value[$i]);
							}elseif($repeater_field['type'] == 'textarea' && !empty($repeater_field)){
								$_row[$repeater_field['id']] = sanitize_textarea_field($_get_field_value[$i]);
							}else{
								$_row[$repeater_field['id']] = sanitize_text_field($_get_field_value[$i]);
							}
						}
						$_repeater_rows_value[] = $_row;
					}
					update_post_meta($post_id, $_meta_key, $_repeater_rows_value);
				}else{
					if(isset($_POST[$field['id']])){
						update_post_meta($post_id, $field['id'], sanitize_text_field($_POST[$field['id']]));
					}else{
						update_post_meta($post_id, $field['id'], sanitize_text_field('off'));
					}
				}
			}
		}
	}

	public static function sanitize_array($arr){
		$sanitized_arr = array();
		if(is_array($arr)){
			foreach($arr as $key => $val){
				$sanitized_arr[$key] = sanitize_text_field($val);
			}
			return $sanitized_arr;
		}else{
			return sanitize_text_field($arr);
		}
	}

	public static function instance(){
		if(!self::$instance){
			self::$instance = new self();
		}

		return self::$instance;
	}
}

new tpmeta_meta_box();