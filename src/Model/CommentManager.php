<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 10/04/18
 * Time: 17:44
 */

namespace Model;


class CommentManager extends AbstractManager
{
    const TABLE = 'comment';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @return array
     */
    public function selectNbCommentsByJob(): array
    {
        $query = 'SELECT count(id) FROM ' . $this->table . ' INNER JOIN job ON job.id = ' . $this->table . '.job_id ';
        return $this->pdoConnection->query($query, \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }

    public function selectAllOrderByState(): array
    {
        return $this->pdoConnection->query('SELECT * FROM ' . $this->table . ' ORDER BY ' . $this->table . '.job_id ASC', \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }
}