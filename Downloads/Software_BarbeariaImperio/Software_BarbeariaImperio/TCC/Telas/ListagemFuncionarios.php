
<?php
function lista_Func(){
      /*1- realizando a conexao com o banco de dados (local, usuario,senha,nomeBanco)*/
      $con=mysqli_connect("localhost","root","","bd_TCC");
 
      /*2- criando o comando sql para consulta dos registros */
      $comandoSql="select ID_Funcionario, Nome_Funcionario from tb_Funcionario where status!=0";
 
      /*3- executando o comando sql */
      $resultado=mysqli_query($con,$comandoSql);   
      
    ?>
    <!--parte do codigo em html -->
    <div class="form-group">
    
     <label for="Funcionario">Barbeiro</label>
     <div class="input-control">
     <select class="form-control" id="Funcionario"  style="height:55px; 	font-size: 21px;" name="Funcionario">

      
    
    
    <?php
   
      /*4- pegando os dados da consulta criada e exibindo */
      while($dados=mysqli_fetch_assoc($resultado)){
       //jogando do banco pra variaveis
     $id=$dados["ID_Funcionario"];
     $nome=$dados["Nome_Funcionario"];
   
     echo"<option value=$id>$nome</option>";
 
   }
   echo"</select>";
   echo"<div class='error'></div>";
   echo"</div>";
   echo"</div>";
 
 } //fim da função lista_Func
 ?>
 <?php

 function lista_Func_cod($cod){
  /*1- realizando a conexao com o banco de dados (local, usuario,senha,nomeBanco)*/
  $con=mysqli_connect("localhost","root","","bd_TCC");

  /*2- criando o comando sql para consulta dos registros */
  $comandoSql="select id_funcionario, nome_funcionario from tb_funcionario";

  /*3- executando o comando sql */
  $resultado=mysqli_query($con,$comandoSql);   
  
?>
<!--parte do codigo em html -->
<div class="form-group">
 <label for="Funcionario">Funcionário</label>
 <div class="input-control">
 <select class="form-control" id="Funcionario" style="height:55px; 	font-size: 21px;"  name="Funcionario">
  


<?php

  /*4- pegando os dados da consulta criada e exibindo */
  while($dados=mysqli_fetch_assoc($resultado)){
   //jogando do banco pra variaveis
 $id=$dados["id_funcionario"];
 $nome=$dados["nome_funcionario"];

 if($cod==$id){
 echo"<option value=$id selected=selected> $nome</option>";
}else {
  echo"<option value=$id> $nome</option>";
}

}
echo"</select>";
echo"<div class='error'></div>";
echo"</div>";
echo"</div>";

}


function lista_Cliente(){
  /*1- realizando a conexao com o banco de dados (local, usuario,senha,nomeBanco)*/
  $con=mysqli_connect("localhost","root","","bd_TCC");

  /*2- criando o comando sql para consulta dos registros */
  $comandoSql="select id_Cliente, Nome_Cliente, Telefone_Cliente from tb_Cliente";

  /*3- executando o comando sql */
  $resultado=mysqli_query($con,$comandoSql);   
  
?>
<!--parte do codigo em html -->
<div class="form-group" >
 <label for="Cliente">Cliente</label>
 <div class="input-control">
 <select class="form-control" id="Cliente"    name="Cliente">
  


<?php
 
  /*4- pegando os dados da consulta criada e exibindo */
  while($dados=mysqli_fetch_assoc($resultado)){
   
   //jogando do banco pra variaveis
 $id=$dados["id_Cliente"];
 $nome=$dados["Nome_Cliente"];
 $tel=$dados["Telefone_Cliente"];

 echo"<option value=$id>$nome -- $tel</option>";
 
}
echo"</select>";
echo"<div class='error'></div>";
echo"</div>";
echo"</div>";

} //fim da função lista_Func









function lista_Cliente_Cod($cod){
  /*1- realizando a conexao com o banco de dados (local, usuario,senha,nomeBanco)*/
  $con=mysqli_connect("localhost","root","","bd_TCC");

  /*2- criando o comando sql para consulta dos registros */
  $comandoSql="select id_Cliente, nome_Cliente, Telefone_Cliente from tb_Cliente";

  /*3- executando o comando sql */
  $resultado=mysqli_query($con,$comandoSql);   
  
?>
<!--parte do codigo em html -->
<div class="form-group">
 <label for="Cliente">Cliente</label>
 <div class="input-control">
 <select class="form-control" id="Cliente" style="height:55px; font-size: 21px;" name="Cliente">
  


<?php

  /*4- pegando os dados da consulta criada e exibindo */
  while($dados=mysqli_fetch_assoc($resultado)){
   //jogando do banco pra variaveis
 $id=$dados["id_Cliente"];
 $nome=$dados["nome_Cliente"];
 $tel=$dados["Telefone_Cliente"];

 if($cod==$id){
 echo"<option value=$id selected=selected>$nome -- $tel</option>";
}else {
  echo"<option value=$id>$nome -- $tel</option>";
}

}
echo"</select>";
echo"<div class='error'></div>";
echo"</div>";
echo"</div>";

}

 ?>




<?php
        function chamaProduto(){
        // Realizando a conexão com o banco de dados
        $con = mysqli_connect("localhost", "root", "", "bd_TCC");

        // Verifica se a conexão foi bem-sucedida
        if (!$con) {
            die("Erro na conexão: " . mysqli_connect_error());
        }

        // Criando o comando SQL para consulta dos registros
        $comandoSql = "SELECT id_produto, nome_produto FROM tb_produto order by id_produto";

        // Executando o comando SQL
        $resultado = mysqli_query($con, $comandoSql);
        
        $numero=mysqli_num_rows($resultado);


        // Verifica se a consulta foi bem-sucedida
        if (!$resultado) {
            die("Erro na consulta: " . mysqli_error($con));
        }

        // Pegando os dados da consulta e exibindo

        while ($dados = mysqli_fetch_assoc($resultado)) {

            $id = $dados["id_produto"];
            $nome = $dados["nome_produto"];
            
            // Gerando IDs e names para campos de texto e checkboxes
            echo "<div class='input-control2'>";
           
                echo "<label for='checkbox$id' style='margin-top:5px'>$nome</label>";
                echo "<input type='checkbox' id='checkbox$id' name='checkbox$id' style='margin-top:14px' value='$id'>";
                echo "<input type='text' id='text$id' name='text$id' style='height:60px'  placeholder='Qtd' >";
                
                echo "<br><div class='error' style='margin-left:3px;margin-right:3px; '></div>";
                echo "</div><br><hr style='border: none; border-top: 1px solid white;''><br>";
          
        }

        echo"<input type='text' name='numero' id='numero' class='d-none' value='$numero'>";

        // Fecha a conexão com o banco de dados
        mysqli_close($con);
    }

    //utilizando uma função para o formulario ser mais facil de entender
   

        ?>

