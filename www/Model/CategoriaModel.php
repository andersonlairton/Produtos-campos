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

    public function atualizar($id = null, $alteracoes = [])
    {

        $strupt = "";
        foreach ($alteracoes as $campo => $valor) {

            if ($campo == 'status') {
                if ($valor = 'true') {
                    $valor = 1;
                }else {
                    $valor = 0;
                }

                $strupt .= "{$campo} = {$valor},";
            }else{
                $strupt .= "{$campo} = '{$valor}',";
            }
        }

        $strupt = rtrim($strupt, ",");
        $sql = "UPDATE Categoria SET {$strupt} WHERE Categoria.id = {$id}";

        $result = $this->executaSql($sql);
        if ($result) {
            return [
                'resposta_status' => [
                    'status' => 0,
                    'msg' => "DADOS ALTERADOS COM SUCESSO"
                ]
            ];
        } else {
            throw new Exception("Falha ao efetuar alteração dos dados ", 1);
        }
    }

    private function executaSql($query)
    {

        $conexao = $this->getConnection();

        if (mysqli_query($conexao, $query)) {
            return true;
        } else {
            return false;
        }
    }

    public function listagemCategorias($inativas = false,$id = null)
    {
        $where = "";

        if ($inativas == 'false') {
            $where = "WHERE Categoria.`status` = 1";
        }

        if (!empty($id)) {
            $where = "WHERE Categoria.`id` = {$id}";
        }

        $conexao = $this->getConnection();

        $sql = "SELECT 
            Categoria.id,
            Categoria.descricao,
            CASE
            WHEN Categoria.`status` = 0 THEN 'Inativo'
            ELSE 'Ativo'
        END AS status
        FROM Categoria
        {$where}";

        $result = mysqli_query($conexao, $sql);
        $dado = [];
        $i = 0;

        while ($linha = mysqli_fetch_array($result)) {
            $dado[$i]['id'] = $linha['id'];
            $dado[$i]['descricao'] = $linha['descricao'];
            $dado[$i]['status'] = $linha['status'];
            $i++;
        }

        mysqli_free_result($result);
        mysqli_close($conexao);

        $retorno = [];
        $retorno['resposta_dados']['dados'] = $dado;
        $retorno['resposta_dados']['qtd'] = $i;

        return $retorno;
    }
}
