<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 18/04/18
 * Time: 14:23
 */

namespace Validator;


class ExtensionUploadValidator extends AbstractValidator
{
    const TYPEMIME = 'L\'image peut être au format jpg, jpeg, png ou gif' ;

    /**
     * @var string
     */
    private $typeMime;

    /**
     * ExtensionUploadValidator constructor.
     * @param string $fichier
     */
    public function __construct(string $typeMime)
    {
        $this->typeMime = $typeMime;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $typeMimes=['image/jpeg','image/jpg','image/png','image/gif'];

        if (!in_array($this->typeMime,$typeMimes)) {
            $this->errors[] = self::TYPEMIME;
            return false;
        }

        return true;
    }
}