<?php
header('Content-Type: application/json');

// Realizando a conexão com o banco de dados
$con = mysqli_connect("localhost", "root", "", "bd_TCC");

// Verifica se a conexão foi bem-sucedida
if (!$con) {
    echo json_encode(['available' => false, 'nome' => '', 'quantidade_estoque' => 0]);
    exit();
}

$id_produto = mysqli_real_escape_string($con, $_POST['id_produto']);
$quantidade = mysqli_real_escape_string($con, $_POST['quantidade']);

// Criando o comando SQL para consultar o estoque
$comandoSql = "SELECT quantidade_estoque, nome_produto FROM tb_produto WHERE id_produto = '$id_produto'";
$resultado = mysqli_query($con, $comandoSql);

if (!$resultado) {
    echo json_encode(['available' => false, 'nome' => '', 'quantidade_estoque' => 0]);
    mysqli_close($con);
    exit();
}

$dados = mysqli_fetch_assoc($resultado);

if ($dados) {
    $quantidade_estoque = $dados['quantidade_estoque'];
    $nome_produto = $dados['nome_produto'];
    
    $available = $quantidade_estoque >= $quantidade;

    echo json_encode([
        'available' => $available,
        'nome' => $nome_produto,
        'quantidade_estoque' => $quantidade_estoque
    ]);
} else {
    echo json_encode(['available' => false, 'nome' => '', 'quantidade_estoque' => 0]);
}

mysqli_close($con);
?>
