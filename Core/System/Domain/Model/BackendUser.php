<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 27.04.2015 @ 22:27
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Model {

	class BackendUser extends User {

		/**
		 * @var string Fullname of backend user
		 */
		protected $name;

		/**
		 * @return string
		 */
		public function getName()
		{
			return $this->name;
		}

		/**
		 * @param string $name
		 */
		public function setName($name)
		{
			$this->name = $name;
		}

	}

}
