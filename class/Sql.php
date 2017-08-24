<?php
/**
 * Created by PhpStorm.
 * User: rafae
 * Date: 21/08/2017
 * Time: 22:32
 */

class Sql extends PDO
{
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
        //parent::__construct($dsn, $username, $passwd, $options);
    }

    private function setParam($statement, $key, $value)
    {
        $statement->bindParam($key,$value);
    }

    private function setParams($statement, $parameters = array())
    {
        foreach ($parameters as $key=>$value) {
            $this->setParam($statement, $key, $value);
        }
    }

    public function query($rawQuery, $params = array())
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    public function select($rawQuery, $params = array()):array
    {
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}