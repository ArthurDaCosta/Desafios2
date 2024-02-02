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
        $funcionario = pg_fetch_row(pg_query($database->connection, "SELECT * FROM funcionarios WHERE id = $this->id"), null, PGSQL_ASSOC);
        if ($funcionario != false) {
            echo "Funcionario de ID=$this->id já existe no banco de dados. <br>";
        } else {
            pg_insert($database->connection, 'funcionarios', (array) $this);
            $database->orderBy('funcionarios', 'id');
            echo "Funcionario de ID=$this->id adicionado ao banco de dados. <br>";
        }
    }

    static function ReadAll(database $database)
    {
        $table = $database->select('funcionarios');
        echo "<br> <h2>Funcionários no Banco de Dados:</h2>";
        if (pg_num_rows($table) == 0) {
            echo "Não há funcionários no banco de dados. <br>";
            exit;
        } else {
            while ($line = pg_fetch_row($table, null, PGSQL_ASSOC)) {
                foreach ($line as $key => $col_value) {
                    echo ucfirst($key) ."= $col_value <br>";
                }
                echo "<br>";
            }
        }
    }   

    static function ReadOne(database $database, $id)
    {
        $funcionario = pg_fetch_array(pg_query($database->connection, "SELECT * FROM funcionarios WHERE id = $id"), null, PGSQL_ASSOC);
        echo "<br> <h2>Funcionario de ID=$id: </h2>";
        if ($funcionario != false) {
            foreach ($funcionario as $key => $col_value) {
                echo ucfirst($key) ."= $col_value <br>";
            }
            echo "<br>";
        } else {
            echo "Funcionario de ID=$id não existe no banco de dados. <br>";
        }
    }

    function Update(database $database)
    {
        $funcionario = pg_fetch_array(pg_query($database->connection, "SELECT * FROM funcionarios WHERE id = $this->id"), null, PGSQL_ASSOC);
        if ($funcionario != false) {
            pg_query($database->connection, "UPDATE funcionarios SET nome = '$this->nome', genero = '$this->genero', idade = $this->idade, salario = $this->salario WHERE id = $this->id");
            $database->orderBy('funcionarios', 'id');
            echo "Funcionario de ID=$this->id atualizado no banco de dados. <br>";
        } else {
            echo "Funcionario de ID=$this->id não existe no banco de dados <br>";
        }
    }

    function Delete(database $database)
    {
        $funcionario = pg_fetch_array(pg_query($database->connection, "SELECT * FROM funcionarios WHERE id = $this->id"), null, PGSQL_ASSOC);
        if ($funcionario != false) {
            pg_delete($database->connection, 'funcionarios', ['id' => $this->id]);
            echo "Funcionario de ID=$this->id removido do banco de dados. <br>";
        } else {
            echo "<br> Funcionario de ID=$this->id não existe no banco de dados \n";
        }
    }

    function AumentarSalario(float $porcentagem)
    {
        $this->salario += $this->salario * ($porcentagem / 100);
    }
}
