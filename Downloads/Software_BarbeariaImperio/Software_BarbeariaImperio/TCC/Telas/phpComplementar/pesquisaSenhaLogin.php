<?php
 $conn=mysqli_connect("localhost","root","","bd_TCC");

  $usuario = $_POST['data'];

  $dados = json_decode($usuario);
 
 $email= $dados->e;
 $senha = $dados->s;
 




    $comandoSql = "select * from tb_funcionario where Login='$email' and senha ='$senha'";

    

 $resultado=mysqli_query($conn,$comandoSql);

 if (mysqli_num_rows($resultado)>0){
	 $dados=mysqli_fetch_assoc($resultado);
	echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "failed"]);

 }


