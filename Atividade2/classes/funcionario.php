<?php

class funcionario
{
    public $id;
    public $nome;
    public $genero;
    public $idade;
    public $salario;

    function __construct($id, $nome, $genero, $idade, $salario)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->genero = $genero;
        $this->idade = $idade;
        $this->salario = $salario;
    }


    function Create()
    {

    }

    function Read()
    {

    }

    function Update()
    {

    }

    function Delete()
    {

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
}