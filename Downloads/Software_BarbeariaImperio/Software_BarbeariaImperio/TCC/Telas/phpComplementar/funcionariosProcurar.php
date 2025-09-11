<?php
$host='localhost';
$db='bd_tcc';
$username='root';
$password='';


$dsn= "mysql:host=$host;dbname=$db";

if($_POST){

try{
    $conn=new PDO($dsn,$username,$password);
    $name = $_POST['Nome_Funcionario'];
    $categoria = $_POST['Telefone_Funcionario'];
    $preco = $_POST['CPF_Funcionario'];
    $quantidade = $_POST['Status'];

    echo $nome.$categoria.$preco.$quantidade;

    
    echo json_encode($results);
}catch (PDOException $e){

    echo $e->getMessage();
}
die();
}
if(isset($_GET['funcionario'])){
    try{
        $conn=new PDO($dsn,$username,$password);
        $results=[];
        if($conn){
            $query=$conn->prepare('select * from tb_Funcionario where Nome_Funcionario like ? order by Status desc');
            $query->execute(array("%" . $_GET['funcionario'] . "%" ??''));
            $results=$query->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode($results);

}catch(PDOException $e){
    echo $e->getMessage();
}
}