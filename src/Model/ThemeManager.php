<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 04/04/18
 * Time: 10:23
 */

namespace Model;


class ThemeManager extends AbstractManager
{
    const TABLE = 'Theme';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}