<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:43
 * Project: Conţinut CMS
 */

namespace Continut\Core\Mvc\Model {

	/**
	 * Class BaseModel
	 *
	 * @package Continut\Core\Mvc\Model
	 * @MappedSuperclass
	 */
	abstract class BaseModel {
		/**
		 * @var int model unique identifier
		 *
		 * @Column(name="id", type="integer", nullable=false)
		 * @Id
		 * @GeneratedValue(strategy="IDENTITY")
		 */
		protected $id;

		/**
		 * @return int Model's unique id in the database
		 */
		public function getId() {
			return $this->id;
		}

		/**
		 * @param int $id new id to use
		 */
		public function setId($id) {
			$this->id = $id;
		}
	}
}