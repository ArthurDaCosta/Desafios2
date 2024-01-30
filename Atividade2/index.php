<?php

require_once __DIR__."/classes/funcionario.php";
require_once __DIR__."/classes/database.php";

$database = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres");
$query = "SELECT * FROM funcionarios";
$result = pg_query($database, $query);

$funcionario1 = new funcionario(20, "João", "Masculino", 25, 2000);
$funcionario2 = new funcionario(21, "Maria", "Feminino", 28, 6000);
$funcionario3 = new funcionario(22, "Carlos", "Masculino", 22, 1000);
$funcionario4 = new funcionario(23, "João", "Masculino", 56, 40000);

$array = [21, "Maria", "Feminino", 28, 6000];

pg_insert($database, 'funcionarios', $funcionario2->toArray());
pg_send_query($database, "DELETE FROM funcionarios WHERE id = $funcionario2->id");

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

