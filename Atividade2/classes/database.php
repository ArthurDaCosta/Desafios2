<?php

class database
{
    function connection()
    {
        $database = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
                or die ("Could not connect.\n");
        return $database;
    }

    function printDB($tableName)
    {
        $table = $this->select($tableName);
        echo "\n<$tableName>";
        while ($line = pg_fetch_array($table, null, PGSQL_ASSOC)) {
            echo "\t\n";
            foreach ($line as $key => $col_value) {
                echo "\t\t $key = $col_value\n";
            }
            echo "\t\n";
        }
    }

    function createTable()
    {
        pg_send_query($this->connection(), "CREATE TABLE public.funcionarios (
            id serial4 NULL,
            nome varchar(100) NULL,
            genero varchar(10) NULL,
            idade int4 NULL,
            salario numeric(10, 2) NULL,
            CONSTRAINT funcionarios_pkey PRIMARY KEY (id)
        );");
    }

    function select($tableName)
    {
        $result = pg_query($this->connection(), "SELECT * FROM $tableName");

        return $result;
    }

    function orderBy($tableName, $order)
    {
        pg_query($this->connection(), "SELECT * FROM $tableName ORDER BY $order");
    }

    

}