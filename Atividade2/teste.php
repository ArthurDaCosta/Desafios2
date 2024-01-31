<?php

$database = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
                or die ("Could not connect.\n");

if(in_array(21, pg_fetch_array(pg_query($database, "SELECT * FROM funcionarios WHERE id = 20"), null, PGSQL_ASSOC)))
{
    echo "\n true \n";
} else {
    echo "\n false \n";
}