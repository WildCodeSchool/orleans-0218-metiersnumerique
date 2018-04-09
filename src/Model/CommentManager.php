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
    const TABLE = 'Job';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectNbCommentsByJob(): array
    {
        $query = 'SELECT count(id) FROM ' . $this->table . ' INNER JOIN Job ON Job.id = ' . $this->table . '.jobId ';
        return $this->pdoConnection->query($query, \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }
}
