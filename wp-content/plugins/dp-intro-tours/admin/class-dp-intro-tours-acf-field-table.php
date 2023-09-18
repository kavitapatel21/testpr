<?php

class Dp_Intro_Tours_Acf_Field_Table extends acf_field {

	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type  function
	*  @date  29/12/2014
	*  @since 5.0.0
	*
	*  @param n/a
	*  @return  n/a
	*/
	private $settings;

	public function __construct() {
		/*
		*  settings (array) Array of settings
		*/
		$this->settings = [
			'version' => '1.3.9',
			'dir_url' => plugins_url( '', __FILE__ ) . '/',
		];

		/*
		*  name (string) Single word, no spaces. Underscores allowed
		*/

		$this->name = 'table';

		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/

		$this->label = __( 'Table', 'acf-table' );

		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/

		$this->category = 'layout';

		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/

		$this->defaults = [
		//'font_size' => 14,
		];

		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('table', 'error');
		*/

		$this->l10n = [
		//'error' => __('Error! Please enter a higher value.', 'acf-table'),
		];

		// do not delete!
		parent::__construct();

		// PREVENTS SAVING INVALID TABLE FIELD JSON DATA {

		if ( ! defined( 'ACF_TABLEFIELD_FILTER_POSTMETA' )
			|| constant( 'ACF_TABLEFIELD_FILTER_POSTMETA' ) === true
		) {

			add_filter(
				'update_post_metadata',
				function ( $x, $object_id, $meta_key, $meta_value, $prev_value ) {

					// detecting ACF table json
					if ( is_string( $meta_value )
						&& strpos( $meta_value, '"acftf":{' ) !== false
					) {

						// is new value a valid json string
						json_decode( $meta_value );

						if ( json_last_error() !== JSON_ERROR_NONE ) {

							// canceling meta value uptdate
							error_log( 'The plugin advanced-custom-fields-table-field prevented a third party update_post_meta( ' . $object_id . ', "' . $meta_key . '", $value ); action that would save a broken JSON string.' . "\n" . 'For details see https://codex.wordpress.org/Function_Reference/update_post_meta#Character_Escaping.' );
							return true;
						}
					}

					return $x;
				},
				10,
				5
			);
		}

		// }

	}

	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*
	*  @type  action
	*  @since 3.6
	*  @date  23/01/13
	*
	*  @param $field (array) the $field being edited
	*  @return  n/a
	*/

	public function render_field_settings( $field ) {
		/*
		*  acf_render_field_setting
		*
		*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
		*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
		*
		*  More than one setting can be added by copy/paste the above code.
		*  Please note that you must also have a matching $defaults value for the field name (font_size)
		*/

		acf_render_field_setting(
			$field,
			[
				'label'         => __( 'Table Header', 'acf-table' ),
				'instructions'  => __( 'Presetting the usage of table header', 'acf-table' ),
				'type'          => 'radio',
				'name'          => 'use_header',
				'choices'       => [
					0 => __( 'Optional', 'acf-table' ),
					1 => __( 'Yes', 'acf-table' ),
					2 => __( 'No', 'acf-table' ),
				],
				'layout'        => 'horizontal',
				'default_value' => 0,
			]
		);

		acf_render_field_setting(
			$field,
			[
				'label'         => __( 'Table Caption', 'acf-table' ),
				'instructions'  => __( 'Presetting the usage of table caption', 'acf-table' ),
				'type'          => 'radio',
				'name'          => 'use_caption',
				'choices'       => [
					1 => __( 'Yes', 'acf-table' ),
					2 => __( 'No', 'acf-table' ),
				],
				'layout'        => 'horizontal',
				'default_value' => 2,
			]
		);
	}

	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param $field (array) the $field being rendered
	*
	*  @type  action
	*  @since 3.6
	*  @date  23/01/13
	*
	*  @param $field (array) the $field being edited
	*  @return  n/a
	*/

	public function render_field( $field ) {
		/*
		*  Review the data of $field.
		*  This will show what data is available
		*/

		if ( empty( $field['use_header'] ) ) {

			$field['use_header'] = 0;
		}

		if ( empty( $field['use_caption'] ) ) {

			$field['use_caption'] = 0;
		}

		$data_field['use_header']  = $field['use_header'];
		$data_field['use_caption'] = $field['use_caption'];

		$e = '';

		$e .= '<div class="acf-table-root">';

		$e .= '<div class="acf-table-optionwrap">';

		// OPTION HEADER {

		if ( $data_field['use_header'] === 0 ) {

			$e .= '<div class="acf-table-optionbox">';
			$e .= '<label for="acf-table-opt-use-header">' . __( 'use table header', 'acf-table' ) . ' </label>';
			$e .= '<select class="acf-table-optionbox-field acf-table-fc-opt-use-header" id="acf-table-opt-use-header" name="acf-table-opt-use-header">';
			$e .= '<option value="0">' . __( 'No', 'acf-table' ) . '</option>';
			$e .= '<option value="1">' . __( 'Yes', 'acf-table' ) . '</option>';
			$e .= '</select>';
			$e .= '</div>';
		}

		// }

		// OPTION CAPTION {

		if ( $data_field['use_caption'] === 1 ) {

			$e .= '<div class="acf-table-optionbox">';
			$e .= '<label for="acf-table-opt-caption">' . __( 'table caption', 'acf-table' ) . ' </label><br>';
			$e .= '<input class="acf-table-optionbox-field acf-table-fc-opt-caption" id="acf-table-opt-caption" type="text" name="acf-table-opt-caption" value=""></input>';
			$e .= '</div>';
		}

		// }

		$e .= '</div>';

		if ( is_array( $field['value'] ) ) {

			$field['value'] = wp_json_encode( $field['value'] );
		}

		if ( is_string( $field['value'] ) ) {

			if ( substr( $field['value'], 0, 1 ) === '{' ) {

				$field['value'] = urlencode( $field['value'] );
			}
		}

		$e .= '<div class="acf-input-wrap">';
		$e .= '<input type="hidden" data-field-options="' . urlencode( wp_json_encode( $data_field ) ) . '" id="' . esc_attr( $field['id'] ) . '"  class="' . esc_attr( $field['type'] ) . '" name="' . esc_attr( $field['name'] ) . '" value="' . $field['value'] . '"/>';
		$e .= '</div>';

		$e .= '</div>';

		echo $e;
	}



	public function input_admin_enqueue_scripts() {
	}


	public function update_value( $value, $post_id, $field ) {
		if ( is_string( $value ) ) {

			$value = wp_unslash( $value );
			$value = urldecode( $value );
			$value = json_decode( $value, true );
		}

		// UPDATE via update_field() {

		if ( isset( $value['header'] )
			|| isset( $value['body'] )
		) {

			$data = get_post_meta( $post_id, $field['name'], true );

			// prevents updating a field, thats data are not defined yet
			if ( empty( $data ) ) {

				return false;
			}

			if ( is_string( $data ) ) {

				$data = json_decode( $data, true );
			}

			if ( isset( $value['use_header'] ) ) {

				$data['p']['o']['uh'] = 1;
			}

			if ( isset( $value['caption'] ) ) {

				$data['p']['ca'] = $value['caption'];
			}

			if ( isset( $value['header'] )
				&& $value['header'] !== false
			) {

				$data['h'] = $value['header'];
			}

			if ( isset( $value['body'] ) ) {

				$data['b'] = $value['body'];
			}

			// SYNCHRONICE TOP ROW DATA WITH CHANGED AMOUNT OF BODY COLUMNS  {

			$new_amount_of_body_cols = count( $value['body'][0] );
			$db_amount_of_top_cols   = count( $data['c'] );

			if ( $new_amount_of_body_cols > $db_amount_of_top_cols ) {

				for ( $i = $db_amount_of_top_cols; $i < $new_amount_of_body_cols; $i++ ) {

					// adds a column entry in top row data
					array_push( $data['c'], [ 'p' => '' ] );
				}
			}

			if ( $new_amount_of_body_cols < $db_amount_of_top_cols ) {

				for ( $i = $new_amount_of_body_cols; $i < $db_amount_of_top_cols; $i++ ) {

					// removes a column entry in top row data
					array_shift( $data['c'] );
				}
			}

			// }

			$value = $data;
		}

		// }

		// $post_id is integer when post is saved, $post_id is string when block is saved
		if ( gettype( $post_id ) === 'integer' ) {

			// only saving a post needs addslashes
			$value = $this->table_slash( $value );
		}

		return $value;
	}

	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
	*
	*  @type  filter
	*  @since 3.6
	*  @date  23/01/13
	*
	*  @param $value (mixed) the value which was loaded from the database
	*  @param $post_id (mixed) the $post_id from which the value was loaded
	*  @param $field (array) the field array holding all the field options
	*
	*  @return  $value (mixed) the modified value
	*/

	public function format_value( $value, $post_id, $field ) {
		if ( is_string( $value ) ) {

			// CHECK FOR GUTENBERG BLOCK CONTENT (URL ENCODED JSON) {

			if ( substr( $value, 0, 1 ) === '%' ) {

				$value = urldecode( $value );
			}

			// }

			$value = json_decode( $value, true ); // decode gutenberg JSONs, but also old table JSONs strings to array
		}

		$a = $value;

		$value = false;

		// IF BODY DATA

		if ( ! empty( $a['b'] )
			&& count( $a['b'] ) > 0
		) {

			// IF HEADER DATA

			if ( ! empty( $a['p']['o']['uh'] ) ) {

				$value['header'] = $a['h'];
			} else {

				$value['header'] = false;
			}

			// IF CAPTION DATA

			if ( ! empty( $field['use_caption'] )
				&& $field['use_caption'] === 1
				&& ! empty( $a['p']['ca'] )
			) {

				$value['caption'] = $a['p']['ca'];
			} else {

				$value['caption'] = false;
			}

			// BODY

			$value['body'] = $a['b'];

			// IF SINGLE EMPTY CELL, THEN DO NOT RETURN TABLE DATA

			if ( count( $a['b'] ) === 1
				&& count( $a['b'][0] ) === 1
				&& trim( $a['b'][0][0]['c'] ) === ''
			) {

				$value = false;
			}
		}

		return $value;
	}


	public function table_slash( $value ) {
		if ( is_array( $value ) ) {

			foreach ( $value as $k => $v ) {

				if ( is_array( $v )
					|| is_object( $v )
				) {
					$value[ $k ] = $this->table_slash( $v );
				} elseif ( is_string( $v ) ) {

					$value[ $k ] = addslashes( $v );
				} else {

					$value[ $k ] = $v;
				}
			}
		} else {

			$value = addslashes( $value );
		}

		return $value;
	}
}

// create field
new Dp_Intro_Tours_Acf_Field_Table();

?>
