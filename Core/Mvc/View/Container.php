<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 18:59
 * Project: Conţinut CMS
 */

namespace Continut\Core\Mvc\View;

class Container extends BaseView
{
    /**
     * @var array List of children elements added to container
     */
    protected $elements = [];

    /**
     * A container belongs to a layout
     *
     * @var BaseLayout
     */
    protected $layout;

    /**
     * @var string Container title
     */
    protected $title;

    /**
     * @var int Container id
     */
    protected $id;

    /**
     * @return BaseLayout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param BaseLayout $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @return mixed
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Add content element to container
     *
     * @param $element
     *
     * @return $this
     */
    public function addElement($element)
    {
        $this->elements[$element->getId()] = $element;

        return $this;
    }

    /**
     * Show all content from a child container, can be called recursively inside other containers
     *
     * @param int $id Id if the container to show
     *
     * @return string
     */
    public function showContainerColumn($id)
    {
        $htmlElements = "";

        foreach ($this->getElements() as $element) {
            if ($element->getColumnId() == $id) {
                $htmlElements .= $element->render($element->children);
            }
        }

        return $htmlElements;
    }

    /**
     * Get container elements
     *
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * Assign the list of elements that this container must render
     *
     * @param $elements array
     *
     * @return $this
     */
    public function setElements($elements)
    {
        $this->elements = $elements;

        return $this;
    }

}
