<?php

namespace CleverreachExtension\Core;

use CleverreachExtension\Core\Api;

/**
 * Register and parse shortcode and also plugin integrations.
 *
 * @since      0.1.0
 * @package    Cleverreach_Extension
 * @subpackage Cleverreach_Extension/includes
 * @author     Sven Hofmann <info@hofmannsven.com>
 */
class Cre_Models {

	/**
	 * Init plugin shortcode.
	 *
	 * @since 0.1.0
	 */
	public function init_shortcodes() {

		add_shortcode(
			'cleverreach_extension',
			array( $this, 'parse_shortcode' )
		);

	}

	/**
	 * Parse shortcode parameters.
	 *
	 * @since 0.1.0
	 * @param $params
	 *
	 * @return string
	 */
	public function parse_shortcode( $params ) {

		$helper = new Cre_Helper();
		$client = new Api\Cleverreach();
		$form   = new Api\Cleverreach_Form_Adapter( $client );

		// Parse shortcode attributes.
		$atts = shortcode_atts(
			array(
				'form_id' => $helper->get_option( 'form_id' ),
			), $params, 'cleverreach_extension'
		);

		$html = '<div class="cr_form-container">';

		// Parse form according to shortcode attributes.
		if ( 'custom' === $atts['form_id'] ) {
			$html .= apply_filters( 'cleverreach_extension_subscribe_form', esc_html__( 'Please apply your own form within your plugin or theme.', 'cleverreachextension' ) );
		} else {
			$result = $form->get_embedded_code( $atts['form_id'] );
			$html .= $result->data;
		}

		$html .= '</div>'; // end of .cr_form-container

		return $html;

	}

}