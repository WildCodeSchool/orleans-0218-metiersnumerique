<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 17/04/18
 * Time: 10:40
 */

namespace Validator;


/**
 * Class AbstractValidator
 * @package AbstractValidator
 */
abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @param string $input
     * @param int $range
     * @return array
     */
    abstract public function isValid(): bool;

    /**
     * @var array
     */
    protected $errors = [];
    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
    /**
     * @param array $errors
     * @return NotEmptyValidator
     */
    public function setErrors(array $errors): AbstractValidator
    {
        $this->errors = $errors;
        return $this;
    }


}