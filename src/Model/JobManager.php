<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 10/04/18
 * Time: 17:44
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

    /**
     * @param int $themeId
     * @return mixed
     */
    public function countNbJobsByThemeId(int $themeId): int
    {
        $query = 'SELECT count(id) as nbJobs FROM ' . $this->table . ' WHERE theme_id = :themeId;';
        $statement = $this->pdoConnection->prepare($query);
        $statement->bindValue(':themeId', $themeId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchColumn(\PDO::FETCH_ASSOC);
    }
}
