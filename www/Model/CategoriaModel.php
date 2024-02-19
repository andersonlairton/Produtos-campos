<?php

include_once("../Source/Config.php");

class CategoriaModel extends Config
{
    public $id;
    public $descricao;
    public $status;
    public function salvar()
    {
        $conexao = $this->getConnection();

        $sql = "INSERT INTO Categoria (Categoria.descricao,Categoria.`status`) 
        VALUES ('{$this->descricao}',{$this->status})";

        if (mysqli_query($conexao, $sql)) {
            return true;
        } else {
            throw new Exception("falha ao cadastrar produto:" . mysqli_error($conexao), 1);
        }
    }
}
