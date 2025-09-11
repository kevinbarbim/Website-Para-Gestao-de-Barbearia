<?php
 $conn=mysqli_connect("localhost","root","","bd_TCC");

  $usuario = $_POST['data'];

  $dados = json_decode($usuario);
 
 $nome= $dados->e;
$id = $dados->s;



if($id==0){
    $comandoSql = "select * from tb_produto where nome_produto = '$nome' ";
}else{
   $comandoSql = "select * from tb_produto where nome_produto = '$nome' and id_produto != '$id'";
}
 $resultado=mysqli_query($conn,$comandoSql);

 if (mysqli_num_rows($resultado)>0){
	 $dados=mysqli_fetch_assoc($resultado);
	echo json_encode(["status" => "failed"]);
} else {
    echo json_encode(["status" => "success"]);

 }


