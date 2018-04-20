<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 18/04/18
 * Time: 14:23
 */

namespace Validator;


class EmailValidator extends AbstractValidator
{
    const EMAIL = 'Ceci ne correspond pas à une adresse email';

    /**
     * @var string
     */
    private $email;

    /**
     * EmailAbstractValidator constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $pattern = '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/';

        if (!preg_match($pattern, $this->email)) {
            $this->errors[] = self::EMAIL;
            return false;
        }

        return true;
    }
}