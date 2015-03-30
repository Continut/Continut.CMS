<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:00
 * Project: Conţinut CMS
 */

namespace Core {

	/**
	 * Main Class that bootstraps the system
	 * @package Core
	 */
	class Bootstrap {

		/**
		 * Current Bootstrap instance
		 *
		 * @var \Core\Boostrap
		 */
		static protected $instance;

		/**
		 * Returns or creates a Bootstrap instance
		 *
		 * @return Boostrap
		 */
		public static function getInstance() {
			if (empty(static::$instance)) {
				static::$instance = new static();
			}
			return static::$instance;
		}

		/**
		 * Loads all the core configurations, like the class mapper, etc
		 *
		 * @return $this
		 */
		public function loadConfiguration() {
			// @TODO - move the load_classes method to a proper class that does Class caching
			spl_autoload_register('load_classes', TRUE, FALSE);
			return $this;
		}

		/**
		 * Start content output
		 *
		 * @return $this
		 */
		public function startOutput() {
			ob_start();
			return $this;
		}

		/**
		 * End content output
		 *
		 * @return $this
		 */
		public function endOutput() {
			ob_end_clean();
			return $this;
		}
	}
}