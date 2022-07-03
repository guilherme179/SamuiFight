<?php

include "conex.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['dia'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Dia da semana!</div>"];
} elseif (empty($dados['nivelTreino'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Nivel do treino!</div>"];
} elseif (empty($dados['treino'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Treino!</div>"];
} else {

    $sql = "INSERT INTO agenda(dia,nivelTreino,treino) VALUES (:dia,:nivelTreino,:treino)";
    $query =$conn->prepare($sql);
    $query->bindParam(':dia', $dados['dia']);
    $query->bindParam(':nivelTreino', $dados['nivelTreino']);
    $query->bindParam(':treino', $dados['treino']);
    $query->execute();

    if($query->rowCount()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'> Aula cadastrada com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Não foi possivel cadastrar a Aula!</div>"];
    }
}

echo json_encode($retorna);

?>