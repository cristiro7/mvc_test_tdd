<?php
/**
 * Base Model class. 
 * All other "real" models extend this class.
 */
class Model 
{
    protected $db;
    protected $sql;

    /**
     * Constructor, expects a Database connection
     */
    public function __construct()
    {
        $this->db = Database::init();
    }

    /** Set the query **/
    protected function setSql($sql)
    {
        $this->sql = $sql;
    }

    /** Get all rows **/
    public function getAll($data = null)
    {
        if (!$this->sql)
        {
            throw new Exception("No SQL query!");
        }

        $sth = $this->db->prepare($this->sql);
        $sth->execute($data);
        return $sth->fetchAll();
    }

    /** Get a row **/
    public function getRow($data = null)
    {
        if (!$this->sql)
        {
            throw new Exception("No SQL query!");
        }

        $sth = $this->db->prepare($this->sql);
        $sth->execute($data);
        return $sth->fetch();
    }
}
