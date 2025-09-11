<?php
 $conn=mysqli_connect("localhost","root","","bd_TCC");

  $usuario = $_POST['data'];

  $dados = json_decode($usuario);
 
 $email= $dados->e;
 




    $comandoSql = "select * from tb_funcionario where Login='$email'";

    

 $resultado=mysqli_query($conn,$comandoSql);

 if (mysqli_num_rows($resultado)>0){
	 $dados=mysqli_fetch_assoc($resultado);
	echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "failed"]);

 }


