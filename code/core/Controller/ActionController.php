<?php

namespace Core\Controller {

	class ActionController {
		protected $request;

		protected $response;

		protected $arguments;

		/**
		 * @var string The folder name where templates for this controller are stored
		 */
		protected $templateStorage;

		public function __construct() {

		}
	}
}