<?php
$host='localhost';
$db='bd_tcc';
$username='root';
$password='';


$dsn= "mysql:host=$host;dbname=$db";

if($_POST){

try{
    $conn=new PDO($dsn,$username,$password);
    $name = $_POST['Nome_Cliente'];
    $categoria = $_POST['Sobrenome_Cliente'];
    $preco = $_POST['Telefone_Cliente'];
  
    echo $nome.$categoria.$preco;

    
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
            $query=$conn->prepare('select * from tb_cliente where Nome_Cliente like ?');
            $query->execute(array("%" . $_GET['cliente'] . "%" ??''));
            $results=$query->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode($results);

}catch(PDOException $e){
    echo $e->getMessage();
}
}