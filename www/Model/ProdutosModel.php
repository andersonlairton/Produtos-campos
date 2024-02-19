<?php
include_once("../Source/Config.php");

class ProdutosModel extends Config
{
    public $id;
    public $descricao;

    public $categoria;

    public function salvar()
    {

        $sql = "INSERT INTO Produtos (Produtos.descricao,Produtos.categoria_id)
        VALUES ('{$this->descricao}',{$this->categoria})";

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

    public function atualizar($id = null, $alteracoes = [])
    {

        $strupt = "";
        foreach ($alteracoes as $campo => $valor) {
            $strupt .= "{$campo} = '{$valor}',";
        }

        $strupt = rtrim($strupt, ",");
        $sql = "UPDATE Produtos SET {$strupt} WHERE Produtos.id = {$id}";

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

    public function listagem($id = null)
    {
        if (!empty($id)) {
            $where = "WHERE Produtos.id = {$id}";
        }
        $sql =  "SELECT 
            Produtos.id,
            Produtos.descricao,
            Categoria.id AS categoria
        FROM Produtos
        INNER JOIN Categoria ON Categoria.id = Produtos.categoria_id
            AND Categoria.`status` = 1
        {$where}";

        $conexao = $this->getConnection();
        $result = mysqli_query($conexao, $sql);
        $dado = [];
        $i = 0;

        while ($linha = mysqli_fetch_array($result)) {
            $dado[$i]['id'] = $linha['id'];
            $dado[$i]['categoria'] = $linha['categoria'];
            $dado[$i]['descricao'] = $linha['descricao'];
            $i++;
        }

        mysqli_free_result($result);
        mysqli_close($conexao);

        $retorno = [];
        $retorno['resposta_dados']['dados'] = $dado;
        $retorno['resposta_dados']['qtd'] = $i;

        return $retorno;
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
}
