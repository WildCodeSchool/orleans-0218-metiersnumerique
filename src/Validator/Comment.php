<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 18/04/18
 * Time: 14:47
 */

namespace Validator;


class Comment implements ValidatorInterface
{
    /**
     * @var array
     */
    private $elements = [];

    /**
     * @var array
     */
    private $errors = [];

    /**
     * Comment constructor.
     * @param array $elements
     */
    public function __construct(array $elements)
    {
        foreach ($elements as $elementName => $elementValidators) {
            foreach ($elementValidators as $elementValidator) {
                if (!$elementValidator instanceof ValidatorInterface) throw new \LogicException('Validator expected.');
            }
        }
        $this->elements = $elements;
    }


    /**
     * @return bool
     */
    public function isValid(): bool
    {
        foreach ($this->elements as $key => $validators) {
            foreach ($validators as $validator) {
                $validator->isValid();
                $this->errors[$key][] = $validator->getErrors();
            }
        }

        foreach ($this->errors as $error) {
            foreach ($error as $err) {
                if (!empty($err)) {
                    return false;
                }
            }
        }

        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}