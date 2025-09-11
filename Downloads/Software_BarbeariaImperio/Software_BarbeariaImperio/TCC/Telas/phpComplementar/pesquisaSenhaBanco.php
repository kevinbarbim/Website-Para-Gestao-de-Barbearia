<?php
 $conn=mysqli_connect("localhost","root","","bd_TCC");

  $usuario = $_POST['data'];

  $dados = json_decode($usuario);
 
 $senha= $dados->e;
$id = $dados->s;




$comandoSql = "select * from tb_funcionario where senha = '$senha' and id_funcionario = '$id' ";


 $resultado=mysqli_query($conn,$comandoSql);


 if (mysqli_num_rows($resultado)>0){
	 $dados=mysqli_fetch_assoc($resultado);
	echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "failed"]);

 }

 
