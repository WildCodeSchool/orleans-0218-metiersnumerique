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

    public function insertComment($idJob, $lastname, $firstname, $email, $wilder, $profession, $company, $q1, $q2, $q3, $like, $date, $valid, $avatar)
    {
        var_dump(get_defined_vars());

        // prepared request
        $query = 'INSERT INTO ' . $this->table . ' 
(job_id, lastname, firstname, email, wilder, profession, 
company, question1, question2, question3, comment.like, comment.date, valid, avatar)
VALUES (:job_id, :lastname, :firstname, :email, 
:wilder, :profession, :company, :q1, :q2, :q3, :likes, :daydate, :valid, :avatar);';
        var_dump($query);
        $statement = $this->pdoConnection->prepare($query);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue(':job_id', $idJob, \PDO::PARAM_INT);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->bindValue(':wilder', $wilder, \PDO::PARAM_STR);
        $statement->bindValue(':profession', $profession, \PDO::PARAM_STR);
        $statement->bindValue(':company', $company, \PDO::PARAM_STR);
        $statement->bindValue(':q1', $q1, \PDO::PARAM_STR);
        $statement->bindValue(':q2', $q2, \PDO::PARAM_STR);
        $statement->bindValue(':q3', $q3, \PDO::PARAM_STR);
        $statement->bindValue(':likes', $like, \PDO::PARAM_INT);
        $statement->bindValue(':daydate', $date, \PDO::PARAM_STR);
        $statement->bindValue(':valid', $valid, \PDO::PARAM_INT);
        $statement->bindValue(':avatar', $avatar, \PDO::PARAM_STR);
        $statement->execute();
    }
}