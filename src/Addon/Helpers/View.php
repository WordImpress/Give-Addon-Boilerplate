<?php

namespace GiveAddon\Addon\Helpers;

use InvalidArgumentException;

/**
 * Helper class responsible for loading add-on views.
 *
 * @package     GiveAddon\Addon\Helpers
 * @copyright   Copyright (c) 2020, GiveWP
 */
class View {

	/**
	 * @param string $view
	 * @param array $vars
	 * @param bool $echo
	 *
	 * @throws InvalidArgumentException if template file not exist
	 *
	 * @return string
	 */
	public static function load( $view, $vars = [], $echo = false ) {
		$template = ADDON_CONSTANT_DIR . 'src/Addon/resources/views/' . $view . '.php';

		if ( file_exists( $template ) ) {
			ob_start();
			extract( $vars );
			include $template;
			$content = ob_get_clean();

			if ( ! $echo ) {
				return $content;
			}

			echo $content;
		}

		throw new InvalidArgumentException( "View template file {$template} not exist" );
	}

	/**
	 * @param string $view
	 * @param array $vars
	 */
	public static function render( $view, $vars = [] ) {
		static::load( $view, $vars, true );
	}
}
