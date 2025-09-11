<?php 
session_start();
$id_func = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Baixa no Servico</title>
  </head>
  <body>

   <div class="container">
    <?php
   
   $valida=0;

    /*1- realizando a conexao com o banco de dados (local, usuario,senha,nomeBanco)*/
    $con=mysqli_connect("localhost","root","","bd_TCC");
    
    /*2- pegando os dados vindos do formulario e armazenando em variaveis */
    $id_servico=$_POST["id"];
    $cod_Cliente=$_POST["Cliente"];
    $data=$_POST["textoData"];
    $horario=$_POST["Horario"];
    $valor=$_POST["valor"];
    $cod_func=$_POST["Funcionario"];
    $cod_pag=$_POST["SelectPagamento"];


    /*3- criando o comando sql para alteracao do registro */
	$comandoSql="update tb_servico set
  cod_Cliente = '$cod_Cliente', Data_Servico='$data', Horario_Servico='$horario', valor_total='$valor', Cod_Funcionario='$cod_func', status=0 where id_Servico='$id_servico'";
	
	/*4- executando o comando sql */
	$resultado=mysqli_query($con, $comandoSql);
	
	/*5- verificando se o comando sql foi executado */
    if($resultado==true){
     $valida++;
     // header('Location: ../FluxoADM/TelaInicialADM.php');
    }else{

      echo"Falha na alteração";
   
    }

 
// starta os arrays
$caixasSelecionadas = [];

$arrayTextos = [];

$num = $_POST['numero']; // Verifica o número de produtos

// checa se o formulario foi enviado

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // checa quais caixas foram selecionadas
    for ($i = 1; $i <= $num; $i++) {
        if (isset($_POST['checkbox' . $i])) {
            $caixasSelecionadas[] = $_POST['checkbox' . $i];
        }
    }

    // pega os valores de texto
    for ($i = 1; $i <= $num; $i++) {
        $TextoIndividual = isset($_POST['text' . $i]) ? $_POST['text' . $i] : '';
        if ($TextoIndividual !== '') { // Ignora vazios
            $arrayTextos[] = $TextoIndividual;
        }
    }
}

//se nenhuma checkbox foi selecionada, é por que o cliente não comprou nada, entao tem q deixar avançar igual
if (empty($caixasSelecionadas)) {
   $valida++;
}

if($valida == 2){
  if($id_func == 1){
  header('Location: ../FluxoADM/TelaInicialADM.php');
  die();
  }else{
    header('Location: ../FluxoFuncionario/TelaInicialFuncionario.php');
  }
}


// inicia uma variavel para rastrear erros, tipo as do validaTel 
$erroTrue = false;

// Garante que os dois arrais estejam de mesmo tamanho, pois em seguida iremos tratalos como uma matriz, pegando os valores das colunas
if (count($caixasSelecionadas) !== count($arrayTextos)) {
    die();
}


for ($i = 0; $i < count($caixasSelecionadas); $i++) {

  $checkbox = mysqli_real_escape_string($con, $caixasSelecionadas[$i]);
  $TextoIndividual = mysqli_real_escape_string($con, $arrayTextos[$i]);

  // Consulta para obter o valor_unitario da tabela tb_produto
  $comandoSqlValor = "SELECT valor_unitario FROM tb_produto WHERE id_produto = '$checkbox'";
  $resultado = mysqli_query($con, $comandoSqlValor);

  if ($resultado && mysqli_num_rows($resultado) > 0) {
     //pega v unitario
      $dadosProduto = mysqli_fetch_assoc($resultado);
      $valorUnitario = $dadosProduto['valor_unitario'];

      //calcula o vpar
      $vpar = $valorUnitario * $TextoIndividual;

      //insert 1
      $comandoSql1 = "INSERT INTO tb_venda_produto (cod_produto, quantidade_produto, cod_servico, valor_parcial) VALUES ('$checkbox', '$TextoIndividual', '$id_servico', $vpar)";

      // arranca do estoque
      $comandoSql2 = "UPDATE tb_produto SET quantidade_estoque = quantidade_estoque - $TextoIndividual WHERE id_produto = '$checkbox'";

      // comeca tranxação
      mysqli_begin_transaction($con);

      // primeiro comando
      if (!mysqli_query($con, $comandoSql1)) {
          $erroTrue = true;
          mysqli_rollback($con);
          break;
      }

      // 2 comando
      if (!mysqli_query($con, $comandoSql2)) {
          $erroTrue = true;
          mysqli_rollback($con);
          break;
      }

      // se tudo certo avança
      mysqli_commit($con);
  } else {
      // caso errado volta do começo com erro
      $erroTrue = true;
      mysqli_rollback($con);
      break;
  }
}


// Verifica se houve erro na inserção
if (!$erroTrue) {
   $valida++;
}

// encerra conexão com o banco
mysqli_close($con);

if($valida == 2){
  if($id_func == 1){
  header('Location: ../FluxoADM/TelaInicialADM.php');
  }else{
    header('Location: ../FluxoFuncionario/TelaInicialFuncionario.php');
  }
}


   ?>
  </div>
  
  </div>
  
  
  
  

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>