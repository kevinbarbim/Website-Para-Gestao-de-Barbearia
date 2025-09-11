<?php
$host='localhost';
$db='bd_tcc';
$username='root';
$password='';


$dsn= "mysql:host=$host;dbname=$db";

if($_POST){

try{
    $conn=new PDO($dsn,$username,$password);
    $name = $_POST['Nome_Produto'];
    $categoria = $_POST['Quantidade_Estoque'];
    $preco = $_POST['Valor_Unitario'];
    

    echo $nome.$categoria.$preco;

    
    echo json_encode($results);
}catch (PDOException $e){

    echo $e->getMessage();
}
die();
}
if(isset($_GET['produto'])){
    try{
        $conn=new PDO($dsn,$username,$password);
        $results=[];
        if($conn){
            $query=$conn->prepare('select * from tb_produto where Nome_Produto like ? order by Status desc');
            $query->execute(array("%" . $_GET['produto'] . "%" ??''));
            $results=$query->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode($results);

}catch(PDOException $e){
    echo $e->getMessage();
}
}