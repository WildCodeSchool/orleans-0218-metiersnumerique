<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 04/04/18
 * Time: 10:27
 */

namespace Model;


class JobManager extends AbstractManager
{
    const TABLE = 'job';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAllOrderByThemeId(): array
    {
        return $this->pdoConnection->query('SELECT * FROM ' . $this->table . ' ORDER BY theme_id', \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }
}