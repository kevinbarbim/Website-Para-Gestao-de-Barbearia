<?php
 $conn=mysqli_connect("localhost","root","","bd_TCC");

  $usuario = $_POST['data'];

  $dados = json_decode($usuario);
 
 $func= $dados->e;
 $datas= $dados->s;
 $hora= $dados->g;
 $id= $dados->i;


if($id==0){
    $comandoSql = "SELECT * FROM tb_servico WHERE cod_funcionario = '$func' AND data_servico = '$datas' AND horario_Servico = '$hora'";    
}else{
    $comandoSql = "SELECT * FROM tb_servico WHERE cod_funcionario = '$func' AND data_servico = '$datas' AND horario_Servico = '$hora' and id_servico != '$id'";    
 
}



 
 $resultado=mysqli_query($conn,$comandoSql);

 if (mysqli_num_rows($resultado)>0){
	 $dados=mysqli_fetch_assoc($resultado);
	echo json_encode(["status" => "failed"]);
} else {
    echo json_encode(["status" => "success"]);

 }


