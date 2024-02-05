<?php

use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;

class BaseModel
{
    private $table;

    public function __construct($table)
    {
        $this->table = $table;
    }
    public function findById($id)
    {
        $builder = new GenericBuilder();
        $query = $builder->select()->setTable($this->table)
            ->where()
            ->equals('id', $id)
            ->end();

        return str_replace(':v1', $id, $builder->writeFormatted($query));
    }
    public function findAll()
    {
        $builder = new GenericBuilder();
        $query = $builder->select()->setTable($this->table);
        return $builder->writeFormatted($query);
    }
    public function findWhereEquals($field, $value)
    {
        $builder = new GenericBuilder();
        $query = $builder->select()->setTable($this->table)
            ->where()
            ->like($field, $value)
            ->end();

        return str_replace(':v1', "'$value'", $builder->writeFormatted($query));
    }
    public function deleteById($id)
    {
        $builder = new GenericBuilder();
        $query = $builder->delete()->setTable($this->table)
            ->where()
            ->equals('id', $id)
            ->end();

        return str_replace(':v1', $id, $builder->writeFormatted($query));
    }
    public function deleteWhere($field, $value)
    {
        $builder = new GenericBuilder();
        $query = $builder->delete()->setTable($this->table)
            ->where()
            ->like($field, $value)
            ->end();

        // return str_replace(':v1', $value, $builder->writeFormatted($query));
        return str_replace(':v1', "'$value'", $builder->writeFormatted($query));
    }
    public function updateById($id, $field, $value)
    {
        $builder=new GenericBuilder();
        $query=$builder->update()->setTable($this->table)
        ->setValues([$field=>$value])
        ->where()
        ->equals('id',$id)
        ->end();

        $request = str_replace(':v1', "'$value'", $builder->writeFormatted($query));
        $request = str_replace(':v2', $id, $request);

        return $request;

    }
}















// class BaseModel
// {
//     private $db;
//     private $table;

//     public function __construct($table)
//     {
//         $this->db = Flight::db();
//         $this->table = $table;
//     }

//     public function getAll()
//     {
//         $query = $this->db->prepare("SELECT * FROM $this->table")->execute();

//         $allData = $query->fetch(PDO::FETCH_ASSOC);

//         if (empty($allData)) {
//             return false;
//         } else {
//             return $allData;
//         }
//     }
// }
