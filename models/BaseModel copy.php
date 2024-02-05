<?php

class BaseModel
{
    private $db;
    private $table;

    public function __construct($table)
    {
        $this->db = Flight::db();
        $this->table = $table;
    }

    public function getAll()
    {
        $query = $this->db->prepare("SELECT * FROM $this->table")->execute();

        $allData = $query->fetch(PDO::FETCH_ASSOC);

        if (empty($allData)) {
            return false;
        } else {
            return $allData;
        }
    }
}
