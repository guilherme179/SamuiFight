<?php

include "conex.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['treino'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo treino!</div>"];
} else {

    $sql = "INSERT INTO treino(treino) VALUES (:treino)";
    $query =$conn->prepare($sql);
    $query->bindParam(':treino', $dados['treino']);
    $query->execute();

    if($query->rowCount()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'> Treino cadastrado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Não foi possivel cadastrar o treino!</div>"];
    }
}

echo json_encode($retorna);

?>