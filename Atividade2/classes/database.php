<?php

class database
{
    public $connection;

    function makeConnection()
    {
        $database = pg_connect("host=postgres port=5432 dbname=postgres user=exemplo password=exemplo")
            or die("Could not connect.\n");
        return $database;
    }

    function createTable()
    {
        $exist = pg_fetch_row(pg_query($this->connection, 
            "SELECT EXISTS ( SELECT * 
            FROM INFORMATION_SCHEMA.TABLES 
            WHERE TABLE_SCHEMA = 'public' 
            AND  TABLE_NAME = 'funcionarios')"));
    
        if($exist[0] == 'f') 
        {
            pg_query($this->connection, "CREATE TABLE public.funcionarios (
                id serial4 NOT NULL,
                nome varchar(100) NULL,
                genero varchar(10) NULL,
                idade int4 NULL,
                salario numeric(10, 2) NULL,
                CONSTRAINT funcionarios_pkey PRIMARY KEY (id)
            );");
        }
        
    }

    function select($tableName)
    {
        $result = pg_query($this->connection, "SELECT * FROM $tableName");

        return $result;
    }

    function orderBy($tableName, $order)
    {
        pg_query($this->connection, "SELECT * FROM $tableName ORDER BY $order");
    }
}
