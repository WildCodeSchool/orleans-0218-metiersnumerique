<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 18/04/18
 * Time: 14:23
 */

namespace Validator;


class ResUploadValidator extends AbstractValidator
{
    const RES = 'L\'image ne doit pas faire moins de 250px de hauteur';

    /**
     * @var string
     */
    private $name;
    private $resmax;

    /**
     * ResUploadValidator constructor.
     * @param string $email
     */
    public function __construct(string $name, int $resmax)
    {
        $this->name = $name;
        $this->resmax = $resmax;

    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $image_sizes = getimagesize($this->name);
        if ($image_sizes[1] < $this->resmax) {
            $this->errors[] = self::RES;
            return false;
        }


        return true;
    }
}