<?php

include_once("../Model/CategoriaModel.php");

class categoriasController
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

            $categoria = new CategoriaModel();
            $categoria->descricao = $dados['descricao'];
            $categoria->status = $dados['status'];

            if($categoria->salvar()== true){
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
            $categoria = new CategoriaModel();
            $this->retorno = $categoria->listagemCategorias($dados['inativas']);
        } catch (Exception $e) {
            $this->retorno = [
                'resposta_status'=>0,
                'msg'=>$e->getMessage()
            ];
        }

        return $this->retorno;
    }

    public function inativar($dados = null) {
        try {
            if (empty($dados['categoria'])) {
                throw new Exception("Nenhum id enviado na requisição", 1);
            }

            $categoria = new CategoriaModel;
            $this->retorno = $categoria->atualizar($dados['categoria'],['status'=>0]);
            
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

        if ($dados['status'] == "") {
            throw new Exception("status nao pode ser vazio", 1);
        }
    }
}
