<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 04/04/18
 * Time: 14:44
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

    public function selectNbCommentsByJob(): array
    {
        $query = 'SELECT count(id) FROM ' . $this->table . ' INNER JOIN job ON job.id = ' . $this->table . '.job_id ';
        return $this->pdoConnection->query($query, \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }
}