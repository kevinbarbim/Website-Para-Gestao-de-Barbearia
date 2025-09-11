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
    $nome = $_POST['Nome_Funcionario'];
    $cliente = $_POST['Nome_Cliente'];
    $data = $_POST['Data_Servico'];
    $hora = $_POST['Horario_Servico'];
    $pag = $_POST['Metodo_Pagamento'];
    $preco = $_POST['Valor_Total'];
  
  
    echo $nome.$cliente.$data.$hora.$pag.$preco;

    
    echo json_encode($results);
}catch (PDOException $e){

    echo $e->getMessage();
}
die();
}
if(isset($_GET['cliente'])){
    try{
        $conn=new PDO($dsn,$username,$password);
        $results=[];
        if($conn){
            $query=$conn->prepare('SELECT s.id_Servico, f.Nome_Funcionario, c.Nome_Cliente, s.Data_Servico, s.Horario_Servico, s.Metodo_Pagamento, s.Valor_Total
            FROM tb_servico s
            JOIN tb_funcionario f ON s.cod_funcionario = f.id_funcionario
            JOIN tb_cliente c ON s.cod_cliente = c.id_cliente
            WHERE s.Data_Servico >= ? AND s.status = 1 and cod_funcionario = '.$id_func.'
            ORDER BY s.Data_Servico ');
    
            $query->execute(array($_GET['cliente']));
            $results=$query->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode($results);

}catch(PDOException $e){
    echo $e->getMessage();
}
}