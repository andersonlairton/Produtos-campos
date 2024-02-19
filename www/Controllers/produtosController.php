<?php

include_once("../Model/ProdutosModel.php");

class produtosController

{
    public $retorno = [
        'resposta_status' => [
            'status' => 0,
            'msg' => ""
        ]
    ];

    public function cadastro($dados = []) {
        try {
         
            $this->validarDadosRequest($dados);
            $produtos = new ProdutosModel();
            $produtos->descricao = $dados['descricao'];
            $produtos->categoria = $dados['categoria'];

            if($produtos->salvar()== true){
                $this->retorno['resposta_status']['msg']= "dados inseridos com sucesso";
            }

        } catch (Exception $e) {
            $this->retorno = [
                'resposta_status'=>0,
                'msg'=>$e->getMessage()
            ];
        }

        return $this->retorno;
    }

    public function listagem($dados = []) {
        try {
            $categoria = new ProdutosModel();
            // $this->retorno = $categoria->listagemCategorias($dados['inativas'],$dados['id']);
            $this->retorno = $categoria->listagem($dados['id']);
        } catch (Exception $e) {
            $this->retorno = [
                'resposta_status'=>0,
                'msg'=>$e->getMessage()
            ];
        }

        return $this->retorno;
    }

    public function atualizar($dados = []) {
        try {
            $this->validarDadosRequest($dados);

            $produtos = new ProdutosModel();
            $alteracoes = [];

            if (!empty($dados['descricao'])) {
                $alteracoes['descricao'] = $dados['descricao'];
            }

            if (!empty($dados['categoria'])) {
                $alteracoes['categoria_id'] = $dados['categoria'];
            }
            if($produtos->atualizar($dados['id'],$alteracoes)== true){
                $this->retorno['resposta_status']['msg']= "dados alterados com sucesso";
            }

        } catch (Exception $e) {
            $this->retorno = [
                'resposta_status'=>0,
                'msg'=>$e->getMessage()
            ];
        }

        return $this->retorno;
    }

    private function validarDadosRequest($dados = []) {
        if (empty($dados['descricao'])) {
            throw new Exception("Descricao não pode ser vazia", 1);
        }

        if (empty($dados['categoria'])) {
            throw new Exception("categoria nao pode ser vazio", 1);
        }
    }
}
