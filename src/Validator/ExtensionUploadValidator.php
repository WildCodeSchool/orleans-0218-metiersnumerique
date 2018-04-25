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
    const EXTENSION = 'L\'image peut être au format jpg, jpeg, png ou gif' ;

    /**
     * @var string
     */
    private $extension;

    /**
     * ExtensionUploadValidator constructor.
     * @param string $fichier
     */
    public function __construct(string $extension)
    {
        $this->extension = $extension;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $extensions=['image/jpeg','image/jpg','image/png','image/gif'];

        if (!in_array($this->extension,$extensions)) {
            $this->errors[] = self::EXTENSION;
            return false;
        }

        return true;
    }
}