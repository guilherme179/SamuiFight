<?php

include "conex.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nome'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
} elseif (empty($dados['idade'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo idade!</div>"];
} elseif (empty($dados['contato'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo contato!</div>"];
} elseif (empty($dados['horario'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo horario!</div>"];
} elseif (empty($dados['modalidade'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo modalidade!</div>"];
} elseif (empty($dados['vencimento'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo vencimento!</div>"];
} else {

    $sql = "INSERT INTO clientes(nome,idade,contato,horario,modalidade,vencimento) VALUES (:nome,:idade,:contato,:horario,:modalidade,:vencimento)";
    $query =$conn->prepare($sql);
    $query->bindParam(':nome', $dados['nome']);
    $query->bindParam(':idade', $dados['idade']);
    $query->bindParam(':contato', $dados['contato']);
    $query->bindParam(':horario', $dados['horario']);
    $query->bindParam(':modalidade', $dados['modalidade']);
    $query->bindParam(':vencimento', $dados['vencimento']);
    $query->execute();

    if($query->rowCount()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'> Aluno cadastrado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Não foi possivel cadastrar o Aluno!</div>"];
    }
}

echo json_encode($retorna);

?>