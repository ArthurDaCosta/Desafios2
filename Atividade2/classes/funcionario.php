<?php

class funcionario
{
    public int $id;
    public string $nome;
    public string $genero;
    public int $idade;
    public float $salario;

    function __construct(int $id, string $nome, string $genero, int $idade, float $salario)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->genero = $genero;
        $this->idade = $idade;
        $this->salario = $salario;
    }


    function Create(database $database)
    {
        if (in_array($this->id, (array)pg_fetch_array(pg_query($database->connection, "SELECT * FROM funcionarios WHERE id = $this->id"), null, PGSQL_ASSOC))) {
            echo "Funcionario de ID=$this->id já existe no banco de dados. <br>";
        } else {
            pg_insert($database->connection, 'funcionarios', (array) $this);
            $database->orderBy('funcionarios', 'id');
        }
    }

    static function ReadAll(database $database)
    {
        $table = $database->select('funcionarios');
        echo "<br> <h2>Funcionários:</h2>";
        while ($line = pg_fetch_array($table, null, PGSQL_ASSOC)) {
            foreach ($line as $key => $col_value) {
                echo "<br> $key = $col_value";
            }
            echo "<br>";
        }
    }

    static function ReadOne(database $database, $id)
    {
        echo "<br> <h2>Funcionario de ID=$id: </h2>";
        if (in_array($id, (array)pg_fetch_array(pg_query($database->connection, "SELECT * FROM funcionarios WHERE id = $id"), null, PGSQL_ASSOC)))
        {
            $table = $database->select("funcionarios WHERE id = $id");
            while ($line = pg_fetch_array($table, null, PGSQL_ASSOC)) {
                foreach ($line as $key => $col_value) {
                    echo "<br> $key = $col_value";
                }
                echo "<br>";
            }
        } else {
            echo "<br> Funcionario de ID=$id não existe no banco de dados.";
        }
    }

    function Update(database $database)
    {
        pg_query($database->connection, "UPDATE funcionarios SET nome = '$this->nome', genero = '$this->genero', idade = $this->idade, salario = $this->salario WHERE id = $this->id");
        $database->orderBy('funcionarios', 'id');
    }

    function Delete(database $database)
    {
        if(in_array($this->id, (array)pg_fetch_array(pg_query($database->connection, "SELECT * FROM funcionarios WHERE id = $this->id"), null, PGSQL_ASSOC))){
            pg_delete($database->connection, 'funcionarios', ['id' => $this->id]);
        } else {
            echo "<br> Funcionario de ID=$this->id não existe no banco de dados \n";
        }
        
    }

    function AumentarSalario(float $porcentagem)
    {
        $this->salario += $this->salario * ($porcentagem / 100);
    }

}