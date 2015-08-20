<?php

namespace CleverreachExtension\Core\Api;

/**
 * Form adapter for CleverReach Api.
 *
 * @since      0.1.0
 * @package    Cleverreach_Extension
 * @subpackage Cleverreach_Extension/includes/api
 * @author     Sven Hofmann <info@hofmannsven.com>
 */
class Cleverreach_Form_Adapter implements Form_Adapter {

	private $cleverreach;

	public function __construct( Cleverreach $cleverreach ) {

		$this->cleverreach = $cleverreach;

	}

	/**
	 * Returns a list of available forms for the given group
	 *
	 * @since 0.1.0
	 *
	 * @param $group_id
	 *
	 * @return string
	 */
	public function get_list( $group_id ) {

		try {
			$result = $this->cleverreach->api_get( 'formsGetList', $group_id );
		} catch ( \Exception $e ) {
			$result = $e->getMessage();
		}

		return $result;

	}

	/**
	 * Returns the HTML code for the given embedded form.
	 *
	 * @since 0.1.0
	 *
	 * @param $form_id
	 *
	 * @return string
	 */
	public function get_code( $form_id ) {

		try {
			$result = $this->cleverreach->api_get( 'formsGetCode', $form_id );
		} catch ( \Exception $e ) {
			$result = $e->getMessage();
		}

		return $result;

	}

	/**
	 * Returns the embedded form HTML code, CSS styles and javascript for the given.
	 *
	 * @since 0.1.0
	 *
	 * @param $form_id
	 *
	 * @return string
	 */
	public function get_embedded_code( $form_id ) {

		try {
			$result = $this->cleverreach->api_get( 'formsGetEmbeddedCode', $form_id );
		} catch ( \Exception $e ) {
			$result = $e->getMessage();
		}

		return $result;

	}

	/**
	 * Will send the activation mail to the given email.
	 *
	 * @since 0.1.0
	 *
	 * @param $form_id
	 * @param $email
	 * @param $data
	 *
	 * @return string
	 */
	public function send_activation_mail( $form_id, $email, $data ) {

		try {
			$result = $this->cleverreach->api_send_mail( 'formsSendActivationMail', $form_id, $email, $data );
		} catch ( \Exception $e ) {
			$result = $e->getMessage();
		}

		return $result;

	}

}