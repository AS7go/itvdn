<?php

use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;

class BaseModel
{
    private $table;
    private $db;

    public function __construct($table)
    {
        $this->table = $table;
        $this->db = Flight::db();
    }
    public function findById($id)
    {
        $builder = new GenericBuilder();
        $query = $builder->select()->setTable($this->table)
            ->where()
            ->equals('id', $id)
            ->end();

        // return str_replace(':v1', $id, $builder->writeFormatted($query));
        $request = str_replace(':v1', $id, $builder->writeFormatted($query));
        $query_db = $this->db->query($request);
        // $query_db->execute();
        // $row=mysqli_fetch_assoc($query_db);
        $row=$query_db -> fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    public function findAll()
    {
        $builder = new GenericBuilder();
        $query = $builder->select()->setTable($this->table);
        $request = $builder->writeFormatted($query);
        $query_db = $this->db->query($request);
        // $rows = $query_db->fetch_all(MYSQLI_ASSOC);
        $rows = $query_db->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($rows);
        return $rows;
        
        // return $builder->writeFormatted($query);
    }
    public function findWhereEquals($field, $value)
    {
        $builder = new GenericBuilder();
        $query = $builder->select()->setTable($this->table)
            ->where()
            ->like($field, $value)
            ->end();

        // return str_replace(':v1', "'$value'", $builder->writeFormatted($query));
        $request = str_replace(':v1', "'$value'", $builder->writeFormatted($query));

        $query_db = $this->db->query( $request );

        $row = $query_db->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    public function deleteById($id)
    {
        $builder = new GenericBuilder();
        $query = $builder->delete()->setTable($this->table)
            ->where()
            ->equals('id', $id)
            ->end();

        // return str_replace(':v1', $id, $builder->writeFormatted($query));
        $request = str_replace(':v1', $id, $builder->writeFormatted($query));
        $query_db = $this->db->query( $request );

        return true;

    }
    public function deleteWhere($field, $value)
    {
        $builder = new GenericBuilder();
        $query = $builder->delete()->setTable($this->table)
            ->where()
            ->like($field, $value)
            ->end();

        // return str_replace(':v1', "'$value'", $builder->writeFormatted($query));
        $request = str_replace(':v1', "'$value'", $builder->writeFormatted($query));
    
        $query_db = $this->db->query( $request );

        return true;
    
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
        
        $query_db = $this->db->query( $request );
        
        // return $request;
        return true;

    }
}