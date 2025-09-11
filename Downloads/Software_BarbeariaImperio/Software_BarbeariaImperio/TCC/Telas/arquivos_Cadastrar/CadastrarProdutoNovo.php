<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Cadastro Produto</title>
  </head>
  
  <body>

    <div class="container">
     <?php
      /*1- realizando a conexao com o banco de dados (local, usuario,senha,nomeBanco)*/
        $con=mysqli_connect("localhost","root","","bd_TCC");

      /*2- pegando os dados vindos do formulario e armazenando em variaveis */
      $nome=ucfirst($_POST["NomeProduto"]);
      $estoque=$_POST["EstoqueInicial"];
      $valor=$_POST["ValorUnitario"];
      $descricao=ucfirst($_POST["DescricaoProduto"]);
    
   

      /*3- criando o comando sql para insercao do registro */
     $comandoSql="insert into tb_Produto (Nome_Produto, Quantidade_Estoque, Valor_Unitario, Descricao_Produto)
     values
     ('$nome', '$estoque', '$valor','$descricao')";

      /*4- executando o comando sql */
     $resultado= mysqli_query($con, $comandoSql);

      /*5- verificando se o comando sql foi executado*/
     if($resultado==true){
      header('Location: ../FluxoADM/TelaInicialADM.php');
    }else {
      
    }

   ?>
  </div>
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>