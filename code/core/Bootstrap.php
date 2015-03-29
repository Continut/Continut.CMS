<?php

namespace Core {

	class Bootstrap {

		/**
		 * Current Bootstrap instance
		 *
		 * @var \Core\Boostrap
		 */
		static protected $instance;

		public static function getInstance() {
			if (empty(static::$instance)) {
				static::$instance = new static();
			}
			return static::$instance;
		}

		/**
		 * Loads all the core configurations, like the class mapper, etc
		 * @return $this
		 */
		public function loadConfiguration() {
			// @TODO - move the load_classes method to a proper class that does Class caching
			spl_autoload_register('load_classes', TRUE, FALSE);
			return $this;
		}

		public function startOutput() {
			ob_start();
			return $this;
		}

		public function endOutput() {
			ob_end_clean();
			return $this;
		}
	}
}