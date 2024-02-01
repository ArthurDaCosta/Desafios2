<?php

require_once __DIR__."/classes/funcionario.php";
require_once __DIR__."/classes/database.php";

$database = new database();
$database->connection = $database->makeConnection();
$database->createTable();

$funcionarios = [ 
    new funcionario(20, "Funcionario 1", "Masculino", 25, 2000),
    new funcionario(21, "Funcionario 2", "Feminino", 28, 6000),
    new funcionario(22, "Funcionario 3", "Masculino", 22, 1000),
    new funcionario(23, "Funcionario 4", "Masculino", 56, 40000)
];
array_multisort($funcionarios, SORT_ASC, SORT_REGULAR);

foreach ($funcionarios as $funcionario) {
    $funcionario->Create($database);
}
echo "\n";

foreach ($funcionarios as $funcionario) {
    $funcionario->nome = "$funcionario->nome alterado";
    $funcionario->AumentarSalario(10);
    $funcionario->Update($database);
}
$database->orderBy('funcionarios', 'id');

Funcionario::ReadALL($database);

$idSave = $funcionarios[0]->id;
unset($funcionarios[0]);

$funcionarioNew = new Funcionario(0, "", "", 0, 0);
$table = $database->select('funcionarios WHERE id = '.$idSave);
while ($line = pg_fetch_array($table, null, PGSQL_ASSOC)) {
    foreach ($line as $key => $col_value) {
        $funcionarioNew->$key = $col_value;
    }
}

echo "<br> <h2>Funcionario pego da DB: </h2>";
print_r($funcionarioNew);
echo "<br>";

array_push($funcionarios, $funcionarioNew);
array_multisort($funcionarios, SORT_ASC, SORT_REGULAR);
$funcionarios = array_values($funcionarios);

if(array_key_exists($key=0, $funcionarios)){
    $funcionarios[$key]->Delete($database);
} else {
    echo "Chave não existe no array \n";
}

$id = 24;
Funcionario::ReadOne($database, $id);

pg_close($database->connection);





