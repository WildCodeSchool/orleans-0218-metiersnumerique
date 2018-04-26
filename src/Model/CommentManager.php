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
                    LIMIT :offset , :limit';

        $statement = $this->pdoConnection->prepare($query);
        $statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
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
  
    public function selectCommentsByJobId(int $jobId, int $offset = 0): array
    {

        $query = "SELECT * FROM $this->table
                    WHERE job_id= :jobId
                    AND valid = 1
                    ORDER BY $this->table.like DESC
                    LIMIT :offset, 3;";

        $statement = $this->pdoConnection->prepare($query);
        $statement->bindValue(':jobId', $jobId, \PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, $this->className);
    }

    public function addLikeByCommentId(int $id)
    {
        $query = 'UPDATE ' . $this->table . ' SET ' . $this->table . '.like = ' . $this->table . '.like +1 WHERE id = :id; ';
        $prep = $this->pdoConnection->prepare($query);
        $prep->bindValue(':id', $id, \PDO::PARAM_INT);
        $prep->execute();
    }

    public function deleteCommentAvatar(int $id)
    {
        $comment = $this->selectOneById($id);
        $avatar = $comment->getAvatar();
        if (file_exists($avatar) && $avatar != 'assets/images/avatar/default_avatar.jpg') {
            unlink($avatar);
        }
    }
}