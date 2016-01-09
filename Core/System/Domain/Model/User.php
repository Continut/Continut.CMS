<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 20:46
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Model {

	use Continut\Core\Mvc\Model\BaseModel;

	/**
	 * Class User
	 *
	 * @package Continut\Core\System\Domain\Model
	 */
	class User extends BaseModel {

		/**
		 * @var string
		 *
		 * @Column(name="username", type="string")
		 */
		protected $username;

		/**
		 * @var string
		 *
		 * @Column(name="password", type="string")
		 */
		protected $password;

		/**
		 * @var bool
		 *
		 * @Column(name="is_deleted", type="boolean")
		 */
		protected $isDeleted;

		/**
		 * @var bool
		 *
		 * @Column(name="is_active", type="boolean")
		 */
		protected $isActive;

		/**
		 * @return string
		 */
		public function getUsername()
		{
			return $this->username;
		}

		/**
		 * @param string $username
		 *
		 * @return User
		 */
		public function setUsername($username)
		{
			$this->username = $username;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getPassword()
		{
			return $this->password;
		}

		/**
		 * @param string $password
		 *
		 * @return User
		 */
		public function setPassword($password)
		{
			$this->password = $password;

			return $this;
		}

		/**
		 * @return boolean
		 */
		public function getIsDeleted()
		{
			return $this->isDeleted;
		}

		/**
		 * @param boolean $isDeleted
		 *
		 * @return User
		 */
		public function setIsDeleted($isDeleted)
		{
			$this->isDeleted = $isDeleted;

			return $this;
		}

		/**
		 * @return boolean
		 */
		public function getIsActive()
		{
			return $this->isActive;
		}

		/**
		 * @param boolean $isActive
		 *
		 * @return User
		 */
		public function setIsActive($isActive)
		{
			$this->isActive = $isActive;

			return $this;
		}
	}

}
