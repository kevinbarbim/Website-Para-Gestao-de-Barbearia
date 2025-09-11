

<!doctype html>
<html>
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
  <head>
    <title> Novo funcionário</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
<!-- Bootstrap CSS Não mexer-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- logo marca -->
<link rel="icon" href="../../imagens/icon.png" width="50" height="50">

  <!--relação com o css individual-->
<link rel="stylesheet" href="../../css/estilo.css" type="text/css">

	  <style>
 


.center-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
   
}

.container-flex {
    display: flex;
    justify-content: center; /* Centraliza o quadrado */
    width: 100%;
    
}



.form-row {
    display: flex;
    justify-content: space-between; /* Centraliza os campos dentro da linha */
    gap: 20px; /* Espaço entre os campos */
    margin-bottom: 9px;
    
}


.form-group {
    flex: 1; /* Faz os grupos ocuparem espaço proporcionalmente */
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-bottom: 25px; /* Reduz o espaço entre os campos */
   
}



.input-control input {
    border: 2px solid #f0f0f0;
	border-radius: 4px;
	display: block;
	font-size: 21px;
	padding: 25px;
	width: 100%;
}
    </style>
  </head>
  <body>
  <script src="../js/Valida_Form_Funcionario.js"></script>

 
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
        }?>
        </li></ul></nav>
        </div>
    </div>
</header>
<!-- imagem de fundo -->
  <main style="position: relative; height: 100vh;">
      <img src="../../imagens/back.jpg" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;"alt="Sua Imagem" class="imagem-escura">
  </main>

  






  <!--inicio quadrado central do cadastro de novos funcionarios-->

  <div class="quadrado-arredondado-geral-horario center-container">
  <div class="container-flex">
    <!-- div do quadrrado preto de fundo-->
    <div class="centro-quadrado-geral">                      <!-- div feita para colocar elementos no meio do quadrado-->

            <h1 class="texto_grande">Cadastro de novos funcionários</h1>
            <div class="botao-superior-direito"> 
            <?php 
             echo"<a href='http://localhost/TCC/Telas/FluxoADM/TelaDecisaoFuncionario.php'><img src='http://localhost/TCC/imagens/seta.png'></a>";
            ?></div>

            <div class="textos_cima_label">
           <form action="../arquivos_Cadastrar/CadastrarFuncionarioNovo.php" method="POST"  id="formCadastroFuncionario" >                                          <!-- inicio do formulario de cadastro do horario do atendimento-->
           
           <div class="form-row">
            
           <input type="text"  id="id" name="id" placeholder="id" value="0" class="d-none">

                  <div class="form-group col-md-6">
                  <div class="input-control">
                       <label for="NomeFuncionario">Nome Funcionário</label>
                       <input type="text" class="form-control" id="NomeFuncionario" name="NomeFuncionario" placeholder="Nome do funcionário"  >
                       <div class="error"></div>
                  </div>
                  </div>
                  <div class="form-group col-md-6">
                  <div class="input-control">
                     <label for="TelFuncionario">Telefone do Funcionário</label>
                     <input type="text" class="form-control" id="TelFuncionario" name="TelFuncionario" placeholder="Telefone do funcionário" >
                     <div class="error"></div>   
                </div> 
                </div>
         
           </div>
  
           <div class="form-row">
                <div class="form-group col-md-4">
                <div class="input-control">
                      <label for="RGFuncionario">RG</label>
                      <input type="text" class="form-control" id="RGFuncionario" name="RGFuncionario" placeholder="RG do funcionário" >
                      <div class="error"></div>
              </div> 
              </div>
                <div class="form-group col-md-4">
                <div class="input-control">
                      <label for="CPFFuncionario">CPF</label>
                     <input type="text" class="form-control" id="CPFFuncionario" name="CPFFuncionario" placeholder="CPF">
                     <div class="error"></div>
              </div> 
              </div>
               <div class="form-group col-md-4">
               <div class="input-control">
                    <label for="SenhaFuncionario">Senha</label>
                    <input type="text" class="form-control" id="SenhaFuncionario" name="SenhaFuncionario" placeholder="Senha">
                    <div class="error"></div>
            </div>
            </div>

          </div>
          <div class="form row">
          <div class="form-group col-md-4">
          <div class="input-control">
                    <label for="LoginFuncionario">Login</label>
                    <input type="text" class="form-control" id="LoginFuncionario" name="LoginFuncionario" placeholder="Login / Email do funcionário" >
                    <div class="error"></div>
              </div>
              </div>
              
          </div>    <div class="form-row">
          <div style="text-align:left">
  <input type="submit" value="Cadastrar" class="btn btn-outline-success sub" id="botaoLogar"></div>
  <div style="text-align:right">
  <a href="Frm_Cadastro_Novo_Funcionario.php"><input type="button" value="Limpar" class="btn btn-outline-danger sub"></a>
</div></div>

  
      
 </form><!-- fim do formulario de cadastro do horario do atendimento-->
</div>
     
</div>
   </div>   <!--fim quadrado-->



</div>








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
   
    

<script src="../../js/validacoes/validaCadastroFuncionario.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script> <!-- pega o link da funcao de validação-->
<script>
  $('#CPFFuncionario').mask('000.000.000-00');  //codigo para adicionar a mascara nos campos, ja serve como validação pois impede add de letras.
  $('#TelFuncionario').mask('(00) 00000-0000'); //função pre pronta do jquery, facilita vidas kk
  $('#RGFuncionario').mask('00.000.000-0');

</script>  


</body>
</html>

