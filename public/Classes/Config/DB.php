<?php

namespace App\Classes\Config;
class DB
{
    private static $_instance = null;
    private $_pdo, $_query, $_errors, $_results, $_count = 0;

    public function __construct()
    {
        try {

            $this->_pdo = new \PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));

        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array())
    {
        $this->_errors = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $pItem = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindvalue($pItem, $param);
                    $pItem++;
                }
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(\PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_errors = true;
            }
        }

        return $this;
    }

    public function action($action, $table, $where = array())
    {
        if (count($where) === 3) {
            $operators = array('=', '>', '<', '!=', '>=', '<=');
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if ($this->query($sql, array($value))) {
                    return $this;
                }
            }
        }
        return false;
    }

    public function get($table, $where)
    {
        return $this->action('SELECT *', $table, $where);
    }

    public function results()
    {
        return $this->_results;
    }

    public function first()
    {
        return $this->results()[0];
    }

    public function delete($table, $where)
    {
        return $this->action('DELETE ', $table, $where);
    }

    public function error()
    {
        return $this->_errors;
    }

    public function count()
    {
        return $this->_count;
    }

    public function insert($table, $fields = array())
    {
        if (count($fields)) {
            $keys = array_keys($fields);
            $values = null;
            $x = 1;

            foreach ($fields as $field) {
                $values .= '?';
                if ($x < count($fields)) {
                    $values .= ', ';
                }
                $x++;
            }
            $sql = "INSERT INTO {$table}(`" . implode('`,`', $keys) . "`) VALUES ({$values})";

            if (!$this->query($sql, $fields)->error()) {
                return true;
            }
        }

    }

    public function update($table, $id, $fields)
    {
        $set = '';
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";

            if ($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }
        $sql = "UPDATE {$table} set {$set} WHERE id = {$id}";

        if (!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

}