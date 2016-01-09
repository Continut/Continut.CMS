<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 05.04.2015 @ 12:40
 * Project: Conţinut CMS
 */

namespace Continut\Extensions\System\Frontend\Classes\Domain\Model {

	use Continut\Core\System\Domain\Model\Page;

	/**
	 * @Table(name="sys_pages")
	 * @Entity(repositoryClass="Continut\Extensions\System\Frontend\Classes\Domain\Collection\FrontendPageCollection")
	 */
	class FrontendPage extends Page {

	}
}