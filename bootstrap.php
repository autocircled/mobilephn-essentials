<?php
/**
 * Bootstrap
 *
 * @since      0.0.1
 *
 * @package    mbl-essen
 */

namespace MblEssen;

use \MblEssen\Includes\Register_Post_Type;
use \MblEssen\Includes\Register_Post_Metas;
use \MblEssen\Includes\Register_Post_Templates;
use \MblEssen\Includes\Helper;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Bootstrap {

	/**
	 * Holds class object
	 *
	 * @var   object
	 * @since 0.0.1
	 */
	private static $instance;

	public function __construct() {
		Register_Post_Type::instance();
		Register_Post_Metas::instance();
		Register_Post_Templates::instance();
		Helper::instance();
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

}
