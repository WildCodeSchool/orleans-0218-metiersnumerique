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

    public function selectAllCommentAndJob(): array
    {
        $query = 'SELECT ' . $this->table . '.*, job.name  FROM ' . $this->table . '
                    JOIN job ON ' . $this->table . '.job_id = job.id
                    ORDER BY ' . $this->table . '.valid ASC, ' . $this->table . '.date DESC';

        return $this->pdoConnection->query($query, \PDO::FETCH_ASSOC)->fetchAll();
    }
}