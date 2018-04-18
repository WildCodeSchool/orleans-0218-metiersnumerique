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
    const RANGE = 'Nombre de caractères dépassé';
    /**
     * @var string
     */
    private $input;
    /**
     * @var int
     */
    private $range;

    /**
     * MaxLengthValidator constructor.
     * @param string $input
     * @param int $range
     */
    public function __construct(string $input, int $range)
    {
        $this->input = $input;
        $this->range = $range;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        if (mb_strlen($this->input) > $this->range) {
            $this->errors[] = self::RANGE;
            return false;
        }

        return true;
    }
}