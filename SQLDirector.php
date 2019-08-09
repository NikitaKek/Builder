<?php
require_once ('SQLQueryBuilder.php');

/** Директор служит бля более */
class SQLDirector
{
    private $builder = NULL;
    private $table;

    /**
     * SQLDirector constructor.
     * @param $table
     */
    public function __construct($table)
    {
        $this->table = "`$table`";
        $this->builder = new SQLQueryBuilder();
    }

    /**
     * @return string
     */
    public function selectAll()
    {
        $this->builder->select($this->table, '*');
        return $this->builder->getSQL();
    }

    /**
     * @param $fields
     * @param $id
     * @return string
     * @throws Exception
     */
    public function updateById($fields, $id)
    {
        $this->builder->update($this->table, $fields);
        $this->builder->where('id', $id);
        return $this->builder->getSQL();
    }

    /**
     * @param $id
     * @return string
     * @throws Exception
     */
    public function deleteById($id)
    {
        $this->builder->delete($this->table);
        $this->builder->where('id', $id);
        return $this->builder->getSQL();
    }

    /**
     * @param array $set
     * @return string
     */
    public function insert(array $set)
    {
        $this->builder->insert($this->table, $set);
        return $this->builder->getSQL();
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }
}