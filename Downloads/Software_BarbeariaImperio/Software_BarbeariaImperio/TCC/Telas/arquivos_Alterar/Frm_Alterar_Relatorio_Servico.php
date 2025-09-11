<!doctype html>
<?php
session_start();

// Verifica se o usuário está logado e se as variáveis de sessão estão setadas
if (!isset($_SESSION['user']) || !isset($_SESSION['senha']) || !isset($_SESSION['id'])) {
  session_destroy();
  header('Location: ../Telas_Iniciais/login.php');
  exit();
}

// Conectar ao banco de dados
$con = mysqli_connect("localhost", "root", "", "bd_TCC");

if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

// Obter o ID do funcionário da sessão
$id_func = $_SESSION['id'];

// Consulta para obter o caminho da imagem de perfil
$comandoSql = "SELECT path FROM tb_Funcionario WHERE id_Funcionario='$id_func'";
$resultado = mysqli_query($con, $comandoSql);

if (!$resultado) {
  die("Error executing query: " . mysqli_error($con));
}

$dados = mysqli_fetch_assoc($resultado);
$pathImagem = $dados["path"] ? htmlspecialchars($dados["path"]) : null; // Caminho da imagem

// Fechar a conexão com o banco de dados
mysqli_close($con);
?>
<html>
<header style="display: flex; justify-content: space-between; align-items: center;">
  <a href="../Telas_Iniciais/index.php"><img src="../../imagens/logo.png" class="logo"></a>

  <div style="display: flex; align-items: center;">
    <nav>
      <ul style="list-style: none; margin: 0; padding: 0; margin-right: 10px;">
        <li>
          <?php echo ($_SESSION['nome']); ?>
        </li>
      </ul>
    </nav>

    <img src="<?php echo $pathImagem; ?>" alt="Imagem de Perfil"
      style="width: 60px; height: 60px; border-radius: 50%; margin-right: 10px;">
    <nav>
      <ul>

        <li>    <?php 
        if($id_func == 1){
        echo"<span class='texto-com-borda'><a href='http://localhost/TCC/Telas/FluxoADM/TelaInicialADM.php'>HOME </a></span>";
        } else{
          echo"<span class='texto-com-borda'><a href='http://localhost/TCC/Telas/FluxoFuncionario/TelaInicialFuncionario.php'>HOME </a></span>"; 
        }?></li>
      </ul>
    </nav>
  </div>
  </div>
</header>

<head>
  <title> Relatório </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS Não mexer-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!-- logo marca -->
  <link rel="icon" href="../imagens/icon.png" width="50" height="50">

  <!--relação com o css individual-->
  <link rel="stylesheet" href="../../css/estilo.css" type="text/css">

  <style>



  </style>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


  <style>
    .table-container {
      width: 100%;
      margin: 20px auto;
      overflow: hidden;
      padding: 0;
      /* Remove o padding da container */
    }

    table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
      /* Força a largura das colunas a serem fixas */
      color: white;
      font-size: 20px;
    }

    td {
      padding: 16px 24px;
      border: 1px solid #fff;
      text-align: left;
      margin-right: 5px;

    }

    th {
      padding: 16px 24px;
      border: 2px solid #fff;
      text-align: left;
      margin-right: 5px;

    }


    .head2 {
      background-color: #4e4e4e;
      border: 2px solid #fff;
      color: #fff;
      font-size: 25px;
      position: sticky;
      top: 0;
      z-index: 2;
    }



    tbody tr:hover {
      background-color: #161616;

    }

    /* Configura a rolagem apenas no corpo da tabela */
    .scrollable-tbody {
      display: block;
      max-height: 150px;
      overflow-y: auto;
      /* Adiciona rolagem vertical */
      overflow-x: hidden;
      /* Remove a rolagem horizontal */
    }

    /* Barra de rolagem vertical personalizada */
    .scrollable-tbody::-webkit-scrollbar {
      width: 6px;
      /* Define a largura da barra de rolagem vertical */
    }

    .scrollable-tbody::-webkit-scrollbar-thumb {
      background-color: #fff;
      /* Define a cor do polegar da barra de rolagem */
    }

    /* Remove a rolagem horizontal da tabela */
    table {
      overflow-x: hidden;
    }

    thead,
    tbody tr {
      display: table;
      width: 100%;
      table-layout: fixed;
    }

    tbody {
      display: block;
      width: 100%;
    }
     .input-control input {
    border: 2px solid #f0f0f0;
	border-radius: 4px;
	display: block;
	font-size: 21px;
	
}
  </style>


</head>

<body>

  <?php

  //colocar o require do index.php
  require "../ListagemFuncionarios.php";

  ?>

  <?php

  /*1- realizando a conexao com o banco de dados (local, usuario,senha,nomeBanco)*/
  $con = mysqli_connect("localhost", "root", "", "bd_TCC");

  /*2- pegando o valor vindo da url */
  $id_servico = $_GET["id"];

  /*3- criando o comando sql para listar os dados do cliente selecionado */
  $comandoSql = "SELECT f.nome_funcionario, s.data_servico, s.tags, s.Horario_Servico, s.Valor_Total, s.Metodo_Pagamento, s.Descricao_Corte, c.nome_cliente, c.id_cliente, s.status
FROM tb_cliente c JOIN tb_servico s ON (cod_cliente = id_cliente)
JOIN tb_funcionario f ON (cod_funcionario = id_funcionario)
WHERE id_servico = $id_servico;
";

  /*4- executando o comando sql */
  $resultado = mysqli_query($con, $comandoSql);

  /*5- pegando os dados da consulta criada e armazenando em variaveis */

  $dados = mysqli_fetch_assoc($resultado);

  $nomeCliente = $dados["nome_cliente"];
  $id_cliente = $dados["id_cliente"];
  $data = $dados["data_servico"];
  $horario = $dados["Horario_Servico"];
  $valor = $dados["Valor_Total"];
  $pagamento = $dados["Metodo_Pagamento"];
  $descricao = $dados["Descricao_Corte"];
  $funcionario = $dados["nome_funcionario"];
  $tags = $dados["tags"];
  $status= $dados["status"];


  ?>


  <?php
  function formatarValor($valor)
  {

    $valor = trim($valor);


    $valor = str_replace(',', '.', $valor);


    if (strpos($valor, '.') === false) {

      $valor .= '.00';
    } else {

      $valor = number_format((float) $valor, 2, '.', '');
    }

    return $valor;
  }


  function dataBrPhp($date)
  {
    return date('d/m/Y', strtotime($date));
  }



  ?>




  <!-- imagem de fundo -->
  <main style="position: relative; height: 100vh;">
    <img src="../../imagens/back.jpg"
      style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;" alt="Sua Imagem"
      class="imagem-escura">
  </main>








  <!--inicio quadrado centro formulario de alteração dos funcionarios-->

  <div class="quadrado-arredondado-geral-cliente">
    <!-- div do quadrrado preto de fundo-->
    <div class="alinhaEsquerda">
      <h1 class="texto_grande">Relatorio do corte do(a)
        <?php echo $nomeCliente ?>
        
      </h1>

      <div class="botao-superior-direito">  <?php 
  
  echo"<a href='http://localhost/TCC/Telas/arquivos_Alterar/Frm_Alterar_Cliente.php?id=$id_cliente'><img src='http://localhost/TCC/imagens/seta.png'></a>";
 
       ?></div>

      <div class="textos_cima_label">
        <form action="Alterar_Funcionario.php" method="POST" id="formCadastroFuncionario">
          <!-- inicio do formulario de cadastro do horario do atendimento-->

          <div class="form-row">

         

            <div class="form-group col-md-6">
              <div class="input-control">
                <label for="NomeFuncionario">Barbeiro</label>
                <input type="text" class="form-control" id="NomeFuncionario" name="NomeFuncionario"
                  placeholder="Nome do funcionário" value="<?php echo $funcionario ?>" readonly>
                <div class="error"></div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="input-control">
                <label for="NomeCliente">Cliente</label>
                <input type="text" class="form-control" id="NomeCliente" name="NomeCliente"
                  placeholder="Telefone do funcionário" value="<?php echo $nomeCliente ?>" readonly>
                <div class="error"></div>
              </div>
            </div>

          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <div class="input-control">
                <label for="DataCorte">Data</label>
                <input type="text" class="form-control" id="DataCorte" name="DataCorte" placeholder="RG do funcionário"
                  value="<?php echo dataBrPhp($data) ?>" readonly>
                <div class="error"></div>
              </div>
            </div>
            <div class="form-group col-md-4">
              <div class="input-control">
                <label for="HorarioCorte">Horario</label>
                <input type="text" class="form-control" id="HorarioCorte" name="HorarioCorte" placeholder="CPF"
                  value="<?php echo $horario ?>" readonly>
                <div class="error"></div>
              </div>
            </div>
            <div class="form-group col-md-4">
              <div class="input-control">
                <label for="MetodoPagamento">Pagamento</label>
                <input type="text" readonly name="MetodoPagamento" class="form-control"
                  value="<?php echo $pagamento ?>">
                <div class="error"></div>
              </div>
            </div>


          </div>
          <div class="form row">




            <div class="form-group">
              <div class="input-control">
                <label for="tags">Tipo de corte</label>
                <input type="text" class="form-control" id="tags" name="tags" placeholder="Tags"
                  value="<?php echo $tags ?>" readonly>
                <div class="error"></div>
              </div>
            </div>
          </div>

          <?php 
if($status == 1){
    echo "<p style='color:red; font-weight:bold;'>Ainda não realizado</p>";
}else{
    echo "<p style='color:green; font-weight:bold;'>Já realizado</p>";
}
?>

          <br>


        </form><!-- fim do formulario de cadastro do horario do atendimento-->
      </div>



    </div>
    <div class="alinhaDireita">
      <!--  aqui comeca uma listagem com repetição dos produtos comprados neste id servico  -->


      <h3 class="texto_grande">Produtos comprados </h3>

      <div class="table-container">
        <table>
          <thead class="head2">
            <tr>
              <th>Produto</th>
              <th>Quantidade</th>

            </tr>
          </thead>
          <tbody class="scrollable-tbody">





            <?php

            /*1- realizando a conexao com o banco de dados (local, usuario,senha,nomeBanco)*/
            $con = mysqli_connect("localhost", "root", "", "bd_TCC");

            /*2- criando o comando sql para consulta dos registros */

            $comandoSql = " SELECT p.nome_produto, v.Quantidade_Produto, v.valor_parcial
                            FROM tb_produto p JOIN tb_venda_produto v ON (cod_produto = id_produto)
                            WHERE cod_servico = $id_servico";

            /*3- executando o comando sql */

            $resultado = mysqli_query($con, $comandoSql);
            $valorTotal = 0;


            /*4- pegando os dados da consulta criada e exibindo */
            while ($dados = mysqli_fetch_assoc($resultado)) {

              //jogando do banco pra variaveis
            
              $nomeProduto = $dados["nome_produto"];
              $quantidadeProduto = $dados["Quantidade_Produto"];
              $unidade = $dados["valor_parcial"];
              $valorTotal = $valorTotal + $unidade;

              //exibindo variaveis
            
              echo "<tr>
 <td>$nomeProduto</td>
 <td>$quantidadeProduto</td>
</tr>";

            }

            ?>

          </tbody>
          <!--fechando tabela 1-->
        </table>
        <!--fechando tabela 2-->
      </div>






      <div class="form row">

        <div class="form-group col-md-4">
          <div class="input-control">
            <label for="ValorTotal" class="textos_cima_label">Valor do Corte</label>
            <input type="text" class="form-control" id="ValorTotal" name="ValorTotal" placeholder="Senha"
              value="<?php echo formatarValor($valor) ?>" readonly>
            <div class="error"></div>
          </div>
        </div>

        <div class="form-group col-md-4">
          <div class="input-control">
            <label for="Produtos" class="textos_cima_label">Total produtos</label>
            <input type="text" class="form-control" id="prod" name="prod" value="<?php echo formatarValor($valorTotal) ?>" readonly>
            <div class="error"></div>
          </div>
        </div>
        <div class="form-group col-md-4">
          <div class="input-control">

            <label for="Totalidade" class="textos_cima_label">Total serviço</label>
            <input type="text" class="form-control" id="Totalidade" name="Totalidade" value="<?php
            $totalidade = $valorTotal + $valor;

            echo formatarValor($totalidade) ?>" readonly>

            <div class="error"></div>
          </div>
        </div>



      </div>

      <div class="form row">
        <div class="form-group">
          <div class="input-control">
            <label for="DescricaoCorte" class="textos_cima_label">Descrição do corte</label>
            <input type="text" style="height: 80px;" class="form-control" id="DescricaoCorte" name="DescricaoCorte"
              placeholder="Login / Email do funcionário" value="<?php echo $descricao ?>" readonly>
            <div class="error"></div>
          </div>
        </div>
      </div>







    </div>
  </div>
  <!--fim quadrado-->






  <footer class="footerhome">
    <p class="rodape">
      Centro Paula Souza - Etec Philadelpho Gouvêa Netto
    </p>
  </footer>






  <!-- Não mexer, essencial para o bootstrap funcionar-->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>

  <script src="../../js/validacoes/validaCadastroCliente.js"></script>
  <!--chama funcoes js-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  <!-- pega o link da funcao de validação-->


  <script>
    $(document).ready(function () {

      $('#HorarioCorte').mask('00:00');  //codigo para adicionar a mascara nos campos, ja serve como validação pois impede add de letras.
      $('#ValorTotal').mask("000.00", { reverse: true });  //função pre pronta do jquery, facilita vidas
    });
  </script>

</body>

</html>