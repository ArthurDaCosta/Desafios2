<?php

require_once __DIR__ . "/classes/Funcionario.php";
require_once __DIR__ . "/classes/Database.php";

$database = new Database();
$database->connection = $database->makeConnection();
$database->createTable();

$funcionarios = [
    new Funcionario(20, "Funcionario 1", "Masculino", 25, 2000),
    new Funcionario(21, "Funcionario 2", "Feminino", 28, 6000),
    new Funcionario(22, "Funcionario 3", "Masculino", 22, 1000),
    new Funcionario(23, "Funcionario 4", "Masculino", 56, 40000)
];
array_multisort($funcionarios, SORT_ASC, SORT_REGULAR);

echo "<br> <h2>Funcionários Adicionados no Banco de Dados: </h2>";
foreach ($funcionarios as $funcionario) {
    $funcionario->Create($database);
}

echo "<br> <h2>Funcionários Alterados no Banco de Dados: </h2>";
foreach ($funcionarios as $funcionario) {
    $funcionario->nome = "$funcionario->nome alterado";
    $funcionario->AumentarSalario(10);
    $funcionario->Update($database);
}
$database->orderBy('funcionarios', 'id');

Funcionario::ReadALL($database);

$num = 0;
$idSave = $funcionarios[$num]->id;
unset($funcionarios[$num]);

$funcionarios[$num] = new Funcionario(0, "", "", 0, 0);
$table = $database->select('funcionarios WHERE id = ' . $idSave);
while ($line = pg_fetch_array($table, null, PGSQL_ASSOC)) {
    foreach ($line as $key => $col_value) {
        $funcionarios[$num]->$key = $col_value;
    }
}

echo "<br> <h2>Funcionario pego do Banco de Dados: </h2>";
print_r($funcionarios[$num]);
echo "<br><br>";

echo "<br> <h2>Funcionario removido do Banco de Dados: </h2>";
if (array_key_exists($key = 2, $funcionarios)) {
    $funcionarios[$key]->Delete($database);
} else {
    echo "Chave não existe no array <br>";
}

$id = 23;
Funcionario::ReadOne($database, $id);

Funcionario::ReadAll($database);

pg_close($database->connection);
