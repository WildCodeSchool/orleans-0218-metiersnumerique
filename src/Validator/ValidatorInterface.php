<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 17/04/18
 * Time: 17:47
 */

namespace Validator;

/**
 * Interface ValidatorInterface
 * @package AbstractValidator
 */
interface ValidatorInterface
{
    /**
     * Vérifie la validité d'une valeur
     *
     * @return bool
     */
    public function isValid(): bool;
}