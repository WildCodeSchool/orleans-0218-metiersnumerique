<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 18/04/18
 * Time: 14:23
 */

namespace Validator;


class SizeUploadValidator extends AbstractValidator
{
    const SIZE = 'L\'image ne doit pas dépasser 500 ko et faire moins de 250px de hauteur';

    /**
     * @var string
     */
    private $size;

    /**
     * SizeUploadValidator constructor.
     * @param string $email
     */
    public function __construct(string $size)
    {
        $this->size = $size;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $sizemax = '500000';

        if ($this->size > $sizemax) {
            $this->errors[] = self::SIZE;
            return false;
        }


        return true;
    }
}