<?php

include "conex.php";

$dados_requisicao = $_REQUEST;

$colunas = [
    0 => 'dia',
    1 => 'nivelTreino',
    2 => 'treino',
];

// Obter a quantidade de registros no banco de dados
$query_qnt_usuarios = "SELECT COUNT(id) AS qnt_usuarios FROM agenda ";

if(!empty($dados_requisicao['search']['value'])){
    $query_qnt_usuarios .= " WHERE dia LIKE :dia";
    $query_qnt_usuarios .= " OR nivelTreino LIKE :nivelTreino";
    $query_qnt_usuarios .= " OR treino LIKE :treino";
}
$result_qnt_usuarios = $conn->prepare($query_qnt_usuarios);

if(!empty($dados_requisicao['search']['value'])){
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_qnt_usuarios->bindParam(':dia', $valor_pesq , PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':nivelTreino', $valor_pesq , PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':treino', $valor_pesq , PDO::PARAM_STR);
}
$result_qnt_usuarios->execute();
$row_qnt_usuarios = $result_qnt_usuarios->fetch(PDO::FETCH_ASSOC);

// Recuperar os registros do banco de dados
$query_usuarios = "SELECT * FROM agenda ";

if(!empty($dados_requisicao['search']['value'])){
    $query_usuarios .= " WHERE dia LIKE :dia";
    $query_usuarios .= " OR nivelTreino LIKE :nivelTreino";
    $query_usuarios .= " OR treino LIKE :treino";
}

$query_usuarios .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']] . " " . $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio , :quantidade";

$result_usuarios = $conn->prepare($query_usuarios);
$result_usuarios->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
$result_usuarios->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);

if(!empty($dados_requisicao['search']['value'])){
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_usuarios->bindParam(':dia', $valor_pesq , PDO::PARAM_STR);
    $result_usuarios->bindParam(':nivelTreino', $valor_pesq , PDO::PARAM_STR);
    $result_usuarios->bindParam(':treino', $valor_pesq , PDO::PARAM_STR);
}

$result_usuarios->execute();

while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
    extract($row_usuario);
    $registro = [];
    $registro[] = $dia;
    $registro[] = $nivelTreino;
    $registro[] = $treino;
    $registro[] = "<button type='button' id='$id' class='btn btn-primary btn-sm' onclick='editAula($id)'>Editar</button>
        <button type='button' id='$id' class='btn btn-danger btn-sm' onclick='apagarAula($id)'>Apagar</button>";
    $dados[] = $registro;
}


//Cria o array de informações a serem retornadas para o Javascript
$resultado = [
    "draw" => intval($dados_requisicao['draw']), // Para cada requisição é enviado um número como parâmetro
    "recordsTotal" => intval($row_qnt_usuarios['qnt_usuarios']), // Quantidade de registros que há no banco de dados
    "recordsFiltered" => intval($row_qnt_usuarios['qnt_usuarios']), // Total de registros quando houver pesquisa
    "data" => $dados // Array de dados com os registros retornados da tabela usuarios
];


// Retornar os dados em formato de objeto para o JavaScript
echo json_encode($resultado);