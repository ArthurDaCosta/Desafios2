<?php

class database
{
    public $connection;

    function makeConnection()
    {
        $database = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
                or die ("Could not connect.\n");
        return $database;
    }

    function createTable()
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