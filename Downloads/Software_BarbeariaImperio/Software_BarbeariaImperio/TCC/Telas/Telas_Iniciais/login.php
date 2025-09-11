<?php 
session_start(); 

if (isset($_SESSION['user']) || isset($_SESSION['senha']) || isset($_SESSION['id'])) {


  if($_SESSION['id'] == 1){
    header('Location: ../FluxoADM/TelaInicialADM.php');
    exit();

  }else{

    header('Location: ../FluxoFuncionario/TelaInicialFuncionario.php');
    exit();
  }

}

?>


<!doctype html>
<html>
  <head>
    <title>Barbearia TCC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
    <!-- Bootstrap CSS Não mexer -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- logo marca -->
    <link rel="icon" href="../../imagens/icon.png" width="50" height="50">

    <!-- Relação com o css individual -->
    <link rel="stylesheet" href="../../css/estilo.css" type="text/css">

    <style>
      .link-voltar {
        text-decoration: none; /* Remove o sublinhamento */
      }
      
      .link-voltar:hover {
        text-decoration: none; /* Remove o sublinhamento quando o mouse passa sobre o link */
      }
    </style>
  </head>
  <body>
    
    <header>
      <a href="../Telas_Iniciais/index.php"><img src="../../imagens/logo.png" class="logo" ></a>                           
      <nav>
        <ul>
          <li> <span class="texto-com-borda"><a href="../Telas_Iniciais/index.php" class="link-voltar">Voltar </a></span></li>
        </ul>
      </nav>
    </header>

    <!-- Começo quadrado -->
    <div class="quadrado-arredondado-login">
      <div class="centro">
        <div class="texto_secundario">
          <h1>LOGIN</h1>

          <div class="botao-superior-direito">
  <?php 
    echo "<a href='http://localhost/TCC/Telas/Telas_Iniciais/index.php'><img src='http://localhost/TCC/imagens/seta.png'></a>";
  ?>
</div>

<form method="POST" action="../BotaoDecisao.php" id="formLogin">
            <div class="form-group">
              <div class="input-control">
                <label for="LoginFuncionario">Usuário</label>
                <input type="text" class="form-control" placeholder="Login" name="LoginFuncionario" id="LoginFuncionario">
                <div class="error"></div>
              </div>
            </div>
            <div class="form-group">
              <div class="input-control">
                <label for="SenhaFuncionario">Senha</label>
                <input type="password" class="form-control" placeholder="Senha" name="SenhaFuncionario" id="SenhaFuncionario">
                <div class="error"></div>
                <div id="verSenha"></div>
              </div>
            </div>
            <br>
            <input type="submit" class="btn btn-outline-light sub" value="Entrar" id="botaoLogar">
          </form>
        </div>
      </div>
    </div>

    <!-- Imagem de fundo -->
    <main style="position: relative; height: 100vh;">
      <img src="../../imagens/back.jpg" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;" alt="Sua Imagem" class="imagem-escura">
    </main>

    <footer class="footerhome">
      <p>
        Centro Paula Souza - Etec Philadelpho Gouvêa Netto
      </p>
    </footer>

    <!-- Não mexer, essencial para o bootstrap funcionar -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   
    <script src="../../js/validacoes/validaLogin.js"></script>


   
   
  </body>
</html>
