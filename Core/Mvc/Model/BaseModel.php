<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:43
 * Project: Conţinut CMS
 */

namespace Continut\Core\Mvc\Model;

use Continut\Core\Utility;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

/**
 * Class BaseModel
 *
 * @package Continut\Core\Mvc\Model
 */
class BaseModel
{
    /**
     * @var int model unique identifier
     */
    protected $id;

    /**
     * @var array
     */
    protected $validationErrors = [];

    /**
     * @return int Model's unique id in the database
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id new id to use
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Simple datamapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        return [
            "id" => $this->id
        ];
    }

    /**
     * Define the list of fields to validate and the validators to validate against
     *
     * @return array List of field names and their validators
     */
    public function dataValidation() {
        return [
            "id" => v::intVal()
        ];
    }

    /**
     * Check if all model properties validate
     *
     * @return bool
     */
    public function validate() {
        $validates = true;
        foreach ($this->dataValidation() as $field => $validators) {
            try {
                $validators->assert($this->fetchFromField($field));
            } catch(NestedValidationException $exception) {
                $this->validationErrors[$field] = $exception->getMessages();
                $validates = false;
            }
            /*if (!$validators->validate($this->fetchFromField($field))) {
                $validates = false;
            }*/
        }

        return $validates;
    }

    /**
     * Returns the validation error messages
     *
     * @param string $field Field name or leave empty to check if we have any errors on all fields of this object
     *
     * @return array
     */
    public function getValidationErrors($field = "") {
        if ($field) {
            if (isset($this->validationErrors[$field])) {
                return $this->validationErrors[$field];
            } else {
                return [];
            }
        }
        return $this->validationErrors;
    }

    /**
     * Checks if we have any validation error messages for a specific field or on all fields
     *
     * @param string $field Field name or leave empty to check if we have any error on all fields
     *
     * @return bool
     */
    public function hasValidationErrors($field = "") {
        if ($field) {
            if (isset($this->validationErrors[$field])) {
                return (sizeof($this->validationErrors[$field]) > 0);
            } else {
                return false;
            }
        }
        return (sizeof($this->validationErrors) > 0);
    }

    /**
     * Updates the values of this model
     *
     * @param array $values Array of key/value pairs to update the model with
     *
     * @return $this
     */
    public function update($values)
    {
        foreach ($values as $key => $value) {
            $modelProperty = Utility::toCamelCase($key);
            if (property_exists($this, $modelProperty)) {
                $method = "set" . ucfirst($modelProperty);
                $this->$method($value);
            }
        }

        return $this;
    }

    /**
     * Returns directly a value by property name
     *
     * @param $key
     *
     * @return mixed
     */
    public function fetchFromField($key)
    {
        if (property_exists($this, $key)) {
            $method = "get" . Utility::toCamelCase($key, TRUE);
            return $this->$method();
        }
        //return null;
    }

    /**
     * Passes all column names to camelCase and forwards the data to the model
     *
     * @param array $data
     *
     * @return void
     */
    public function setDataFromDatabase($data) {
        foreach ($data as $fieldName => $fieldValue) {
            if (array_key_exists($fieldName, $this->dataMapper())) {
                $modelAttributeName = Utility::toCamelCase($fieldName);
                $this->$modelAttributeName = $fieldValue;
            }
        }
    }

    /**
     * Returns the dataMapper model data as JSON
     *
     * @return string
     */
    public function toJson() {
        return json_encode($this->dataMapper());
    }
}
