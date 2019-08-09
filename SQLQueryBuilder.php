<?php

/** Этот Конкретный Строитель может создавать SQL-запросы, совместимые с MySQL. */
class SQLQueryBuilder
{
    protected $query;

    protected function reset()
    {
        $this->query = new \STDclass;
    }

    /**
     * Построение базового запроса SELECT
     * @param $table
     * @param $fields
     * @return $this
     */
    public function select($table, $fields)
    {
        $this->reset();
        $fields = $fields == '*'? $fields : implode(", ", $fields);
        $this->query->base = "SELECT " . $fields . " FROM " . $table;
        $this->query->type = 'select';

        return $this;
    }

    /**
     * Построение базового запроса UPDATE
     * @param $table
     * @param $fields
     * @return $this
     */
    public function update($table, array $fields)
    {
        $this->reset();
        $set = array();
        foreach ($fields as $key => $value){
            $set[] = "$key='$value'";
        }
        $set = implode(',', $set);
        $this->query->base = "UPDATE ". $table . " SET " . $set;
        $this->query->type = 'update';

        return $this;
    }

    /**
     * Построение базового запроса DELETE
     * @param $table
     * @return $this
     */
    public function delete($table)
    {
        $this->reset();
        $this->query->base = "DELETE FROM ". $table;
        $this->query->type = 'delete';

        return $this;
    }

    /**
     * Посроение базового запроса INSERT
     * @param $table
     * @param array $set
     */
    public function insert($table, array $set)
    {
        $keys = array_keys($set);
        $values = array_values($set);
        $keys = implode(',', $keys);
        $values = implode(',', $values);
        $this->reset();
        $this->query->base = "INSERT INTO $table ($keys) VALUES ($values)";
    }

    /**
     * Добавление условия WHERE
     * @param $field
     * @param $value
     * @param string $operator
     * @return $this
     * @throws Exception
     */
    public function where($field, $value, $operator = '=')
    {
        if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new \Exception("WHERE can only be added to SELECT, DELETE OR UPDATE");
        }
        $this->query->where[] = "$field $operator '$value'";

        return $this;
    }

    /**
     * Добавление ограничения LIMIT
     * @param $start
     * @param $offset
     * @return $this
     * @throws Exception
     */
    public function limit($start, $offset)
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("LIMIT can only be added to SELECT");
        }
        $this->query->limit = " LIMIT " . $start . ", " . $offset;

        return $this;
    }

    /**
     * Получение окончательной строки запроса
     * @return string
     */
    public function getSQL()
    {
        $query = $this->query;
        $sql = $query->base;
        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }
        if (isset($query->limit)) {
            $sql .= $query->limit;
        }
        $sql .= ";";

        return $sql;
    }

}