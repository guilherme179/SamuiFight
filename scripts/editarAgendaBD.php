<?php

include "conex.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($dados['dia'])){
    $query_usuario = "UPDATE agenda SET dia = :dia WHERE id = :id";
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':dia', $dados['dia']);
    $edit_usuario->bindParam(':id', $dados['id']);
    
    if($edit_usuario->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Aula editada com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Aula não editada!</div>"];
    }
}

if(!empty($dados['nivelTreino'])){
    $query_usuario = "UPDATE agenda SET nivelTreino = :nivelTreino WHERE id = :id";
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':nivelTreino', $dados['nivelTreino']);
    $edit_usuario->bindParam(':id', $dados['id']);

    if($edit_usuario->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Aula editada com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Aula não editada!</div>"];
    }
}

if(!empty($dados['treino'])){
    $query_usuario = "UPDATE agenda SET treino = :treino WHERE id = :id";
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':treino', $dados['treino']);
    $edit_usuario->bindParam(':id', $dados['id']);

    if($edit_usuario->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Aula editada com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Aula não editada!</div>"];
    }
}

echo json_encode($retorna);