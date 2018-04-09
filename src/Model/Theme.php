<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 04/04/18
 * Time: 10:04
 */

namespace Model;


class Theme
{
    private $id;

    private $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Theme
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Theme
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
