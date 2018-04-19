<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 18/04/18
 * Time: 12:10
 */

namespace Validator;

/**
 * Class NotEmptyValidator
 * @package Model
 */
class NotEmptyValidator extends AbstractValidator
{
    const NOT_EMPTY = 'Valeur vide non autorisée';

    /**
     * @var mixed
     */
    private $input;

    /**
     * NotEmptyValidator constructor.
     * @param $input
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        if (empty($this->input)) {
            $this->errors[] = self::NOT_EMPTY;
            return false;
        }
        return true;
    }
}