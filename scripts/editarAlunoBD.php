<?php

include "conex.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($dados['nome'])){
    $query_usuario = "UPDATE clientes SET nome = :nome WHERE id = :id";
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':nome', $dados['nome']);
    $edit_usuario->bindParam(':id', $dados['id']);
    
    if($edit_usuario->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Aluno editado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Aluno não editado!</div>"];
    }
}

if(!empty($dados['idade'])){
    $query_usuario = "UPDATE clientes SET idade = :idade WHERE id = :id";
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':idade', $dados['idade']);
    $edit_usuario->bindParam(':id', $dados['id']);

    if($edit_usuario->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Aluno editado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Aluno não editado!</div>"];
    }
}

if(!empty($dados['contato'])){
    $query_usuario = "UPDATE clientes SET contato = :contato WHERE id = :id";
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':contato', $dados['contato']);
    $edit_usuario->bindParam(':id', $dados['id']);

    if($edit_usuario->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Aluno editado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Aluno não editado!</div>"];
    }
}

if(!empty($dados['horario'])){
    $query_usuario = "UPDATE clientes SET horario = :horario WHERE id = :id";
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':horario', $dados['horario']);
    $edit_usuario->bindParam(':id', $dados['id']);

    if($edit_usuario->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Aluno editado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Aluno não editado!</div>"];
    }
}

if(!empty($dados['modalidade'])){
    $query_usuario = "UPDATE clientes SET modalidade = :modalidade WHERE id = :id";
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':modalidade', $dados['modalidade']);
    $edit_usuario->bindParam(':id', $dados['id']);

    if($edit_usuario->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Aluno editado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Aluno não editado!</div>"];
    }
}

if(!empty($dados['vencimeto'])){
    $query_usuario = "UPDATE clientes SET vencimeto = :vencimeto WHERE id = :id";
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(':vencimeto', $dados['vencimeto']);
    $edit_usuario->bindParam(':id', $dados['id']);

    if($edit_usuario->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Aluno editado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Aluno não editado!</div>"];
    }
}

echo json_encode($retorna);