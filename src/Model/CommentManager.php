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
        $query = 'SELECT  job_id, count(' . $this->table . '.id) as nbrComments 
                    FROM ' . $this->table . ' 
                    INNER JOIN job ON job.id = ' . $this->table . '.job_id
                    WHERE comment.valid = 1
                    GROUP BY job_id';

        return $this->pdoConnection->query($query, \PDO::FETCH_ASSOC)->fetchAll();
    }

    public function selectAllCommentAndJob(int $limit, int $offset): array
    {
        $query = 'SELECT ' . $this->table . '.*, job.name  FROM ' . $this->table . '
                    JOIN job ON ' . $this->table . '.job_id = job.id
                    ORDER BY ' . $this->table . '.valid ASC, ' . $this->table . '.date DESC
                    LIMIT ' . $offset . ', ' . $limit;

        return $this->pdoConnection->query($query, \PDO::FETCH_ASSOC)->fetchAll();
    }

    public function countNbComments()
    {
        $query = 'SELECT count(id) as nbComments FROM ' . $this->table . ';';
        return $this->pdoConnection->query($query, \PDO::FETCH_ASSOC)->fetchColumn();

    }

    public function selectCommentAndJob(int $id): array
    {
        $query = 'SELECT ' . $this->table . '.*, job.name  FROM ' . $this->table . '
                    JOIN job ON ' . $this->table . '.job_id = job.id
                    WHERE ' . $this->table . '.id = :id  ;';

        $statement = $this->pdoConnection->prepare($query);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectCommentsByJobId(int $jobId): array
    {
        $query = 'SELECT * FROM ' . $this->table . '
                    WHERE job_id=' . $jobId
            . ' AND valid = 1 LIMIT 3' . ';';

        return $this->pdoConnection->query($query, \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }
}