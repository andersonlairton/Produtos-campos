<?php
// variaveis de retorno
$retorno = [
    'resposta_status' => [
        'status' => 0,
        'msg' => ""
    ]
];

if (isset($_REQUEST['component'])) {
    // verificando se o arquivo existe na pasta controller
    if (file_exists("../Controllers/{$_REQUEST['component']}.php")) {
        $retorno = verificaaction($_REQUEST['component'], 'Controllers');
    } elseif (file_exists("../Models/{$_REQUEST['component']}.php")) {
        $classe = str_replace('Model', '', $_REQUEST['component']);
        $retorno = verificaaction($classe, "Models");
    } else {
        $retorno['resposta_status']['status'] = 0;
        $retorno['resposta_status']['msg'] = "Arquivo não localizado,servidor obteve resposta.Cod:" . __LINE__;
    }


} else {
    $retorno['resposta_status']['status'] = 0;
    $retorno['resposta_status']['msg'] = "Parametro nao localizado,servidor obteve resposta.Cod:" . __LINE__;
}

function verificaaction($class = null, $pasta = null)
{

    if (isset($_REQUEST['action'])) {
        require_once "../{$pasta}/{$_REQUEST['component']}.php";

        // verificando se a classe existe
        if (class_exists($class)) {

            $c = new $class();

            // verificando se a função desejada existe
            if (method_exists($c, $_REQUEST['action'])) {

                $funcao = $_REQUEST['action'];

                $retorno = $c->$funcao($_REQUEST);
            } else {
                $retorno['resposta_status']['status'] = 0;
                $retorno['resposta_status']['msg'] = "Função {$_REQUEST['action']} não localizda,servidor não obteve resposta.Cod:" . __LINE__;
            }
        } else {
            $retorno['resposta_status']['status'] = 0;
            $retorno['resposta_status']['msg'] = "Classe {$class} não localizada,servidor não obteve resposta.Cod:" . __LINE__;
        }
    } else {
        $retorno['resposta_status']['status'] = 0;
        $retorno['resposta_status']['msg'] = "Parametro nao localizado,servidor obteve resposta.Cod:" . __LINE__;
    }

    return $retorno;
}

echo json_encode($retorno);