<?php

require_once __DIR__."/classes/funcionario.php";
require_once __DIR__."/classes/database.php";

$database = new database();
$database->createTable();

//Criar Funcionarios
$funcionarios = [ 
    new funcionario(20, "Funcionario 1", "Masculino", 25, 2000),
    new funcionario(21, "Funcionario 2", "Feminino", 28, 6000),
    new funcionario(22, "Funcionario 3", "Masculino", 22, 1000),
    new funcionario(23, "Funcionario 4", "Masculino", 56, 40000)
];

//Adicionar Funcionarios ao banco
foreach ($funcionarios as $funcionario) {
    $funcionario->Create($database);
}

//Alterar Funcionarios
foreach ($funcionarios as $funcionario) {
    $funcionario->nome = "$funcionario->nome alterado";
    $funcionario->AumentarSalario(10);
    $funcionario->Update($database);
}
$database->orderBy('funcionarios', 'id');

//Print Funcionarios
$database->printDB('funcionarios');

//Unset Funcionario
$idSave = $funcionarios[0]->id;
unset($funcionarios[0]);

//Puxar funcionario do banco
$funcionarioNew = new Funcionario(0, "", "", 0, 0);
$table = $database->select('funcionarios WHERE id = '.$idSave);
while ($line = pg_fetch_array($table, null, PGSQL_ASSOC)) {
    foreach ($line as $key => $col_value) {
        $funcionarioNew->$key = $col_value;
    }
}

//Print Novo Funcionario
print_r($funcionarioNew);

//Adicionar pro Array de Funcionarios
array_push($funcionarios, $funcionarioNew);

//Delete Funcionario do banco
if(array_key_exists($key=0, $funcionarios)){
    $funcionarios[$key]->Delete($database);
} else {
    echo "Chave não existe no array \n";
}


//Print Funcionarios
$database->printDB('funcionarios');




