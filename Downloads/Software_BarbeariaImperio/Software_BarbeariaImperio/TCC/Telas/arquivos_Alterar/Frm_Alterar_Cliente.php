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
$pathImagem = $dados["path"] ? htmlspecialchars($dados["path"]) : null;// Caminho da imagem
 
// Fechar a conexão com o banco de dados
mysqli_close($con);
?>
<html>
  <head>
    <title> Alterar Cliente</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
<!-- Bootstrap CSS Não mexer-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 
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
            margin: 50px auto;
            overflow: hidden;
            padding: 0; /* Remove o padding da container */
        }
 
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Força a largura das colunas a serem fixas */
            color:white;
            font-size:20px;
        }
 
        td {
            padding: 16px 24px;
            border: 1px solid   #fff;
            text-align: left;
            margin-right:5px;
            word-wrap: break-word;
           
        }
 
        th {
            padding: 16px 24px;
            border: 2px solid   #fff;
            text-align: left;
            margin-right:5px;
           
        }
 
 
        .head2{
            background-color: #4e4e4e;
            border: 2px solid   #fff;
            color: #fff;
            font-size:25px;
            position: sticky;
            top: 0;
            z-index: 2;
        }
 
   
 
        tbody tr:hover {
            background-color:   #161616;
           
        }
 
        /* Configura a rolagem apenas no corpo da tabela */
        .scrollable-tbody {
            display: block;
            max-height: 330px;
            overflow-y: auto; /* Adiciona rolagem vertical */
            overflow-x: hidden; /* Remove a rolagem horizontal */
        }
 
        /* Barra de rolagem vertical personalizada */
        .scrollable-tbody::-webkit-scrollbar {
            width: 6px; /* Define a largura da barra de rolagem vertical */
        }
 
        .scrollable-tbody::-webkit-scrollbar-thumb {
            background-color: #fff; /* Define a cor do polegar da barra de rolagem */
        }
 
        /* Remove a rolagem horizontal da tabela */
        table {
            overflow-x: hidden;
        }
 
        thead, tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
 
        tbody {
            display: block;
            width: 100%;
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
$con=mysqli_connect("localhost","root","","bd_TCC");
 
/*2- pegando o valor vindo da url */
$id_cli=$_GET["id"];
 
/*3- criando o comando sql para listar os dados do cliente selecionado */
$comandoSql="select * from tb_cliente where id_cliente='$id_cli'";
 
/*4- executando o comando sql */
$resultado=mysqli_query($con, $comandoSql);
 
/*5- pegando os dados da consulta criada e armazenando em variaveis */
 
$dados=mysqli_fetch_assoc($resultado);
 
$nome=$dados["Nome_Cliente"];
$sobrenome=$dados["Sobrenome_Cliente"];
$telefone=$dados["Telefone_Cliente"];
$email=$dados["Email_Cliente"];
 
 
?>
 
<?php
function dataBrPhp($date) {
  return date('d/m/Y', strtotime($date));
 }
 
?>
 
 
 
 
<header style="display: flex; justify-content: space-between; align-items: center;">
    <a href="../Telas_Iniciais/index.php"><img src="../../imagens/logo.png" class="logo"></a>
 
    <div style="display: flex; align-items: center;">
        <nav>
            <ul style="list-style: none; margin: 0; padding: 0; margin-right: 10px;">
                <li><?php echo($_SESSION['nome']); ?></li>
            </ul>
        </nav>
       
        <img src="<?php echo $pathImagem; ?>" alt="Imagem de Perfil" style="width: 60px; height: 60px; border-radius: 50%; margin-right: 10px;">
        <nav>
        <ul>
       
        <li>    <?php 
        if($id_func == 1){
        echo"<span class='texto-com-borda'><a href='http://localhost/TCC/Telas/FluxoADM/TelaInicialADM.php'>HOME </a></span>";
        } else{
          echo"<span class='texto-com-borda'><a href='http://localhost/TCC/Telas/FluxoFuncionario/TelaInicialFuncionario.php'>HOME </a></span>"; 
        }?></li></ul></nav>
        </div>
    </div>
</header>
<!-- imagem de fundo -->
  <main style="position: relative; height: 100vh;">
      <img src="../../imagens/back.jpg" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;"alt="Sua Imagem" class="imagem-escura">
  </main>
 
 
 
 
 
 
 
 
  <!--inicio quadrado centro formulario de alteração dos funcionarios-->
 
  <div class="quadrado-arredondado-geral-cliente">           <!-- div do quadrrado preto de fundo-->
<!-- como faz a div certa?? -->                      
 
 
<div class="alinhaEsquerda">
<h1 class="texto_grande">Relatorio de <?php echo $nome ?></h1>

<div class="botao-superior-direito"> <?php 
  
  echo"<a href='http://localhost/TCC/Telas/Cliente/ListagemClientes.php'><img src='http://localhost/TCC/imagens/seta.png'></a>";
 
       ?></div>
 
<form action="Alterar_Cliente.php" method="POST"  id="formCadastroCliente">                                          <!-- inicio do formulario de cadastro do horario do atendimento-->
           <div class="textos_cima_label">
           
           <div class="form-row">
 
           <input type="text"  id="id" name="id" placeholder="id" value="<?php echo $id_cli?>" class="d-none">
                           
           
                  <div class="form-group col-md-6">
                       <div class="input-control">
                             <label for="NomeCliente" >Nome Cliente</label>
                             <input type="text"  id="NomeCliente" name="NomeCliente" placeholder="Nome do Cliente" value="<?php echo $nome?>">
                             <div class="error"></div>
                      </div>
                 </div>
                 <div class="form-group col-md-6">
                       <div class="input-control">
                            <label for="SobreCliente">Sobrenome Cliente</label>
                            <input type="text"  id="SobreCliente" name="SobreCliente" placeholder="Sobrenome do Cliente" value="<?php echo $sobrenome?>" >
                            <div class="error"></div>
                       </div>
                </div>
           </div>
           <div class="form-row">
                <div class="form-group col-md-6">
                      <div class="input-control">
                            <label for="TelCliente">Telefone do Cliente</label>
                            <input type="text"  id="TelCliente" name="TelCliente" placeholder="Telefone do Cliente" value="<?php echo $telefone?>">
                             <div class="error"></div>
                      </div>
                </div>
                <div class="form-group col-md-6">
                       <div class="input-control">
                             <label for="emailCliente">Email do cliente</label>
                             <input type="text"  id="emailCliente" name="emailCliente" placeholder="Email do Cliente" value="<?php echo $email?>">
                              <div class="error"></div>
                        </div>
                </div>
            </div>
           
 
       
 
 
  <input type="submit" value="Alterar" class="btn btn-outline-success sub"  id="botaoLogar">
 </div><!-- fim texto cima label-->
 </form><!-- fim do formulario de cadastro do horario do atendimento-->
 
 
 
 
 
 
</div>
 
 
 
<!-- comeco da listagem de cortes do cliente -->
<div class="alinhaDireita">
 
<h3 class="texto_grande">Serviços do Cliente </h3>
 
   
<div class="table-container">
<table>
 
<thead class="head2">
<tr>
  <th >Barbeiro </th>
  <th >Data</th>
  <th>Relatório</th>
</tr>
</thead>
 
<tbody class="scrollable-tbody">
 
 
 
 
 
<?php
 
 /*1- realizando a conexao com o banco de dados (local, usuario,senha,nomeBanco)*/
 $con=mysqli_connect("localhost","root","","bd_TCC");
 
 /*2- criando o comando sql para consulta dos registros */
 
$comandoSql="SELECT f.nome_funcionario, c.Data_Servico, c.Horario_Servico , c.id_servico
FROM tb_cliente JOIN tb_servico c on(cod_cliente = id_cliente)
JOIN tb_funcionario f ON(cod_funcionario = id_funcionario)
WHERE id_cliente = $id_cli ORDER BY c.Data_Servico;
 
";
 
 /*3- executando o comando sql */
 
$resultado=mysqli_query($con,$comandoSql);  
 
 
 
 /*4- pegando os dados da consulta criada e exibindo */
 while($dados=mysqli_fetch_assoc($resultado)){
 
  //jogando do banco pra variaveis
 
$id=$dados["id_servico"];
$funcionario=$dados["nome_funcionario"];
$data=$dados["Data_Servico"];
 
$dataCerta=dataBrPhp($data);
 
 
 
 //exibindo variaveis
 
echo"<tr>
 <td  class='centroCelula'>$funcionario</td>
 <td  class='centroCelula'>$dataCerta</td>
 <td class='centroCelula'><a href='Frm_Alterar_Relatorio_Servico.php?id=$id'> <img src='../../imagens/excluir.png' > </a></td>
</tr>";
 
}
 
 
?>
 
</tbody> <!--fechando tabela 1-->
</table> <!--fechando tabela 2-->
</div>
 
 
 
 
 
</div>
<!-- final da listagem de cortes do cliente -->
 
 
 
         
   
   </div><!--fim quadrado-->
 
 
 
 
 
 
     <footer class="footerhome">
        <p class="rodape">
         Centro Paula Souza - Etec Philadelpho Gouvêa Netto
        </p>
     </footer>  
 
 
 
 
 
 
    <!-- Não mexer, essencial para o bootstrap funcionar-->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   
 
 
 
    <script src="../../js/validacoes/validaCadastroCliente.js"></script> <!--chama funcoes js-->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script> <!-- pega o link da funcao de validação-->
 
<script>
 
  $('#TelCliente').mask('(00) 00000-0000'); //função pre pronta do jquery, facilita vidas kk
 
 
</script>
 
  </body>
</html>