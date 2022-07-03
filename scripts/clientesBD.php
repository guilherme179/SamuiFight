<?php

include "conex.php";

$dados_requisicao = $_REQUEST;

$colunas = [
    0 => 'nome',
    1 => 'idade',
    2 => 'contato',
    3 => 'horario',
    4 => 'modalidade',
    5 => 'vencimento',
    6 => 'diferenca',
];

// Obter a quantidade de registros no banco de dados
$query_qnt_usuarios = "SELECT COUNT(id) AS qnt_usuarios FROM clientes";

if(!empty($dados_requisicao['search']['value'])){
    $query_qnt_usuarios .= " WHERE nome LIKE :nome";
    $query_qnt_usuarios .= " OR idade LIKE :idade";
    $query_qnt_usuarios .= " OR contato LIKE :contato";
    $query_qnt_usuarios .= " OR horario LIKE :horario";
    $query_qnt_usuarios .= " OR modalidade LIKE :modalidade";
    $query_qnt_usuarios .= " OR vencimento LIKE :vencimento";
}
$result_qnt_usuarios = $conn->prepare($query_qnt_usuarios);

if(!empty($dados_requisicao['search']['value'])){
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_qnt_usuarios->bindParam(':nome', $valor_pesq , PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':idade', $valor_pesq , PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':contato', $valor_pesq , PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':horario', $valor_pesq , PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':modalidade', $valor_pesq , PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':vencimento', $valor_pesq , PDO::PARAM_STR);
}
$result_qnt_usuarios->execute();
$row_qnt_usuarios = $result_qnt_usuarios->fetch(PDO::FETCH_ASSOC);

// Recuperar os registros do banco de dados
$query_usuarios = "SELECT *, DATEDIFF(CURRENT_DATE(), vencimento) as diferenca FROM clientes ";

if(!empty($dados_requisicao['search']['value'])){
    $query_usuarios .= " WHERE nome LIKE :nome";
    $query_usuarios .= " OR idade LIKE :idade";
    $query_usuarios .= " OR contato LIKE :contato";
    $query_usuarios .= " OR horario LIKE :horario";
    $query_usuarios .= " OR modalidade LIKE :modalidade";
    $query_usuarios .= " OR vencimento LIKE :vencimento";
}

$query_usuarios .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']] . " " . $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio , :quantidade";

$result_usuarios = $conn->prepare($query_usuarios);
$result_usuarios->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
$result_usuarios->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);

if(!empty($dados_requisicao['search']['value'])){
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_usuarios->bindParam(':nome', $valor_pesq , PDO::PARAM_STR);
    $result_usuarios->bindParam(':idade', $valor_pesq , PDO::PARAM_STR);
    $result_usuarios->bindParam(':contato', $valor_pesq , PDO::PARAM_STR);
    $result_usuarios->bindParam(':horario', $valor_pesq , PDO::PARAM_STR);
    $result_usuarios->bindParam(':modalidade', $valor_pesq , PDO::PARAM_STR);
    $result_usuarios->bindParam(':vencimento', $valor_pesq , PDO::PARAM_STR);
}

$result_usuarios->execute();

while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
    extract($row_usuario);
    $registro = [];
    $registro[] = $nome;
    $registro[] = $idade;
    $registro[] = $contato;
    $registro[] = $horario;
    $registro[] = $modalidade;
    $registro[] = $vencimento;
    if($diferenca < -3){
        $diferenca = "em dia";
    } else if ($diferenca == -3 ){
        $diferenca = "3 dias para vencer";
    } else if ($diferenca == -2 ){
        $diferenca = "2 dias para vencer";
    } else if ($diferenca == -1 ){
        $diferenca = "1 dias para vencer";
    } else {
        $diferenca = "venceu";
    }
    $registro[] = $diferenca;
    $registro[] = "<button type='button' id='$id' class='btn btn-primary btn-sm' onclick='editAluno($id)'>Editar</button>
        <button type='button' id='$id' class='btn btn-danger btn-sm' onclick='apagarAluno($id)'>Apagar</button>";
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