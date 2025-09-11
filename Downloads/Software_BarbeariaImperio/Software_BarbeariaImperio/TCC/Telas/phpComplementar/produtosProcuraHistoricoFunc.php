<?php
session_start();
$id_func = $_SESSION['id'];

$host='localhost';
$db='bd_tcc';
$username='root';
$password='';


$dsn= "mysql:host=$host;dbname=$db";

if($_POST){

try{
    $conn=new PDO($dsn,$username,$password);
    $name = $_POST['nome_produto'];
    $categoria = $_POST['data_servico'];
    $preco = $_POST['quantidade_produto'];
    $Func = $_POST['nome_funcionario'];
    $cli = $_POST['nome_cliente'];
    $idd = $_POST['id_produto'];
    

    echo $nome.$categoria.$preco.$Func.$cli.$idd;

    
    echo json_encode($results);
}catch (PDOException    $e){

    echo $e->getMessage();
}
die();
}
if(isset($_GET['datatxt'])){
    try{
        $conn=new PDO($dsn,$username,$password);
        $results=[];
        if($conn){
            $query=$conn->prepare('select p.id_produto, p.nome_produto, s.data_servico, v.quantidade_produto, f.nome_funcionario, c.nome_cliente
            FROM tb_produto p 
            JOIN tb_venda_produto v      ON (cod_produto = id_produto)
            JOIN tb_servico s            ON (cod_servico = id_servico)
            JOIN tb_funcionario f        ON (cod_funcionario = id_funcionario)
            JOIN tb_cliente c            ON (cod_cliente = id_cliente) 
            WHERE data_servico >= ? and cod_funcionario = '.$id_func.' order by data_servico desc');
            $query->execute(array($_GET['datatxt']));
            $results=$query->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode($results);

}catch(PDOException $e){
    echo $e->getMessage();
}
}