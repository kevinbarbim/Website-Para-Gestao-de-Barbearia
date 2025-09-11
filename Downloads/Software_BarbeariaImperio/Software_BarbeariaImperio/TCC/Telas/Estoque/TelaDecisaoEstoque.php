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
    <title> Menu</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
<!-- Bootstrap CSS Não mexer-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- logo marca -->
<link rel="icon" href="../../imagens/icon.png" width="50" height="50">

  <!--relação com o css individual-->
<link rel="stylesheet" href="../../css/estilo.css" type="text/css">

<style>

 

</style>
	  
  </head>
  <body>
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

 <!-- Começo quadrado -->
     <div class="quadrado-arredondado-estoque">           <!-- div do quadrado preto de fundo-->
      <div class="centro">                        <!-- div feita para colocar elementos no meio do quadrado-->
        <div class="texto_secundario">           <!--div feita para colocar a fonte bonita-->
        <div class="d-flex justify-content-between align-items-center" style="height: 25vh;">
          

        <div class="botao-superior-direito"> <?php 
  if($id_func == 1){
   echo"<a href='http://localhost/TCC/Telas/FluxoADM/TelaInicialADM.php'><img src='http://localhost/TCC/imagens/seta.png'></a>";
  }else{

    echo"<a href='http://localhost/TCC/Telas/FluxoFuncionario/TelaInicialFuncionario.php'><img src='http://localhost/TCC/imagens/seta.png'></a>";
  }
  ?></div>




        <?php 
        if($id_func == 1){
            echo" <a href='Frm_Cadastro_Novo_Produto.php'>
           <button type='button' class='btn btn-outline-light buttonadm2'>NOVO PRODUTO</button>
          </a>";
         }
        ?>

        <a href="ListagemProdutosEstoque.php">
        <button type="button" class="btn btn-outline-light buttonadm2">ESTOQUE ATUAL</button>
        </a>

       <?php 
       if($id_func == 1){
        echo"<a href='ListagemHistoricoEstoque.php'>
        <button type='button' class='btn btn-outline-light buttonadm2'>HISTÓRICO ESTOQUE</button>
        </a>";
       }else{
        echo"<a href='ListagemHistoricoEstoqueFunc.php'>
        <button type='button' class='btn btn-outline-light buttonadm2'>HISTÓRICO ESTOQUE</button>
        </a>";
       }
        ?>
        </div>
      </div>  <!--fim fonte bonita-->
      </div>  <!--fim centro-->
     </div>   <!--fim quadrado-->


<!-- imagem de fundo -->
  <main style="position: relative; height: 100vh;">
      <img src="../../imagens/back.jpg" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;"alt="Sua Imagem" class="imagem-escura">
  </main>

  

       
           


  
     <footer class="footerhome">
        <p class="rodape">
         Centro Paula Souza - Etec Philadelpho Gouvêa Netto
        </p>
     </footer>	







     <!-- Não mexer, essencial para o bootstrap funcionar-->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>
</html>

