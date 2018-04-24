<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 20:52
 * PHP version 7
 */

namespace Model;

use App\Connection;

/**
 * Abstract class handling default manager.
 */
abstract class AbstractManager
{
    protected $pdoConnection; //variable de connexion

    protected $table;
    protected $className;

    /**
     *  Initializes Manager Abstract class.
     *
     * @param string $table Table name of current model
     */
    public function __construct(string $table)
    {
        $connexion = new Connection();
        $this->pdoConnection = $connexion->getPdoConnection();
        $this->table = $table;
        $this->className = __NAMESPACE__ . '\\' . ucfirst($table);
    }

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAll(): array
    {
        return $this->pdoConnection->query('SELECT * FROM ' . $this->table, \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }

    /**
     * Get one row from database by ID.
     *
     * @param  int $id
     *
     * @return array
     */
    public function selectOneById(int $id)
    {
        // prepared request
        $statement = $this->pdoConnection->prepare("SELECT * FROM $this->table WHERE id=:id");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    /**
     * DELETE on row in database by ID
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $sql = "DELETE FROM $this->table WHERE id=:id";
        $statement = $this->pdoConnection->prepare($sql);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * INSERT one row in database
     *
     * @param array $data
     * @return bool
     */
    public function insert(array $data)
    {
        $fields = array_keys($data);

        $query = "INSERT INTO $this->table 
                  (" . implode(',' . $this->table .'.', $fields) . ")
                  VALUES  (:" . implode(', :', $fields) . ")";

        $statement = $this->pdoConnection->prepare($query);

        foreach ($data as $field => $value) {
            if(gettype($value) == 'integer' || gettype($value) == 'double') {
                $statement->bindValue($field, $value, \PDO::PARAM_INT);
            } elseif (gettype($value) == 'string') {
                $statement->bindValue($field, $value, \PDO::PARAM_STR);
            } elseif (gettype($value) == 'boolean') {
                $statement->bindValue($field, $value, \PDO::PARAM_BOOL);
            } elseif (gettype($value) == 'NULL') {
                $statement->bindValue($field, $value, \PDO::PARAM_NULL);
            }
        }

        $resultQuery = $statement->execute();
        return $resultQuery;
    }


    /**
     * @param int $id Id of the row to update
     * @param array $data $data to update
     * @return bool
     */
    public function update(int $id, array $data)
    {
        $fields = array_keys($data);

        $query = "UPDATE $this->table 
                  SET " . implode(' = :' . implode(', ', $fields) . ' = :' , $fields ) . "
                  WHERE id=$id";

        $statement = $this->pdoConnection->prepare($query);

        foreach ($data as $field => $value) {
            if(gettype($value) == 'integer' || gettype($value) == 'double') {
                $statement->bindValue($field, $value, \PDO::PARAM_INT);
            } elseif (gettype($value) == 'string') {
                $statement->bindValue($field, $value, \PDO::PARAM_STR);
            } elseif (gettype($value) == 'boolean') {
                $statement->bindValue($field, $value, \PDO::PARAM_BOOL);
            } elseif (gettype($value) == 'NULL') {
                $statement->bindValue($field, $value, \PDO::PARAM_NULL);
            }
        }

        $resultQuery = $statement->execute();
        return $resultQuery;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param array $order
     * @return array
     */
    public function select(int $limit, int $offset, $order=[]): array
    {
        $orderStr = ' ORDER BY ';
        $sep = '';
        foreach ($order as $col => $val) {
            $orderStr .= $sep . $col .' '. $val;
            $sep = ', ';
        }

        $sql = 'SELECT * FROM ' . $this->table . $orderStr . ' LIMIT ' . $offset . ', ' . $limit;

        return $this->pdoConnection->query($sql,\PDO::FETCH_CLASS, $this->className)->fetchAll();
    }
}
