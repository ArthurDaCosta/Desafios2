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


    function Create($database)
    {
        if (in_array($this->id, (array)pg_fetch_array(pg_query($database->connection(), "SELECT * FROM funcionarios WHERE id = $this->id"), null, PGSQL_ASSOC))) {
            echo "Funcionario de ID=$this->id já existe no banco de dados \n";
        } else {
            pg_insert($database->connection(), 'funcionarios', $this->toArray());
            $database->orderBy('funcionarios', 'id');
        }
        
    }

    function Read()
    {
        return $this->toArray();
    }

    function Update($database)
    {
        pg_query($database->connection(), "UPDATE funcionarios SET nome = '$this->nome', genero = '$this->genero', idade = $this->idade, salario = $this->salario WHERE id = $this->id");
        $database->orderBy('funcionarios', 'id');
    }

    function Delete($database)
    {
        if(in_array($this->id, (array)pg_fetch_array(pg_query($database->connection(), "SELECT * FROM funcionarios WHERE id = $this->id"), null, PGSQL_ASSOC))){
            pg_query($database->connection(), "DELETE FROM funcionarios WHERE id =". $this->id ."");
        } else {
            echo "Funcionario de ID=$this->id não existe no banco de dados \n";
        }
        
    }

    function toArray()
    {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "genero" => $this->genero,
            "idade" => $this->idade,
            "salario" => $this->salario
        ];
    }

    function AumentarSalario($porcentagem)
    {
        $this->salario += $this->salario * ($porcentagem / 100);
    }
}