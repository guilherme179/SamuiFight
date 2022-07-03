<?php 

include_once "conex.php";

$id = filter_input(INPUT_GET, "id",  FILTER_SANITIZE_NUMBER_INT);

if(!empty($id)){
    $apagar = "DELETE FROM agenda WHERE id=:id";
    $result = $conn->prepare($apagar);
    $result->bindParam(":id", $id);

    if($result->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Aula apagada com sucesso!</div>"];
    } else {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Não foi possivel apagar esta aula!</div>"];
    }

} else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Não foi possivel apagar esta aula!</div>"];
}

echo json_encode($retorna);