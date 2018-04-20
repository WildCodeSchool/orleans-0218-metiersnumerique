<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 18/04/18
 * Time: 14:23
 */

namespace Validator;


class MaxLengthValidator extends AbstractValidator
{
    const MAX_LENGTH = 'Nombre de caractères dépassé';
    /**
     * @var string
     */
    private $input;
    /**
     * @var int
     */
    private $length;

    /**
     * MaxLengthValidator constructor.
     * @param string $input
     * @param int $range
     */
    public function __construct(string $input, int $length)
    {
        $this->input = $input;
        $this->length = $length;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        if (mb_strlen($this->input) > $this->length) {
            $this->errors[] = self::MAX_LENGTH;
            return false;
        }

        return true;
    }
}