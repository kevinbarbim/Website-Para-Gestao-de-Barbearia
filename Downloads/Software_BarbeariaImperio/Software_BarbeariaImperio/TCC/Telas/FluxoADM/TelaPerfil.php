<!doctype html>
<html>

<head>
    <title>Menu perfil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS Não mexer -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- logo marca -->
    <link rel="icon" href="../imagens/icon.png" width="50" height="50">
    <!-- relação com o css individual -->
    <link rel="stylesheet" href="../../css/estilo.css" type="text/css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .center-container {
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
            /* Alinha os itens no centro horizontalmente */
        }
        .form-rows {
    display: flex;
    flex-direction: column;
    width: 500px;
    align-items: center;
}
        input[type="file"] {
            display: none;
        }

        .container-flex {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .image-upload-section, .form-section {
            width: 48%;
            
        }

        .image-upload-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: 100px;
        }
        
        .form-section {
            text-align: center;
        }
        .profile-image {
        width: 150px; 
        height: 150px;
        object-fit: cover; 
        border-radius: 50%; 
    }
  .info{
    font-size: 25px;
    text-align: center;
    margin-top: 8px;
    margin-bottom: 20px;
  }
  .input-control input {
    border: 2px solid #f0f0f0;
	border-radius: 4px;
	display: block;
	font-size: 21px;
	
}
    
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    session_start();

    // Realiza a conexão com o banco de dados
    $con = mysqli_connect("localhost", "root", "", "bd_TCC");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Obtém o ID do funcionário da sessão
    $id_func = $_SESSION['id'];

    // Cria o comando SQL para listar os dados do funcionário selecionado
    $comandoSql = "SELECT * FROM tb_Funcionario WHERE id_Funcionario='$id_func'";
    $resultado = mysqli_query($con, $comandoSql);

    if (!$resultado) {
        die("Error executing query: " . mysqli_error($con));
    }

    // Obtém os dados da consulta e armazena em variáveis
    $dados = mysqli_fetch_assoc($resultado);

    $nome = $dados["Nome_Funcionario"];
    $telefone = $dados["Telefone_Funcionario"];
    $rg = $dados["RG_Funcionario"];
    $cpf = $dados["CPF_Funcionario"];
    $senha = $dados["Senha"];
    $ativo = $dados["Status"];
    $login = $dados["Login"];
    $pathImagem = $dados["path"] ? htmlspecialchars($dados["path"]) : null; // Caminho da imagem 

    // Lida com o upload do arquivo
    if (isset($_FILES['arquivo'])) {
        $arquivo = $_FILES['arquivo'];
        if ($arquivo['error']) {
            die("Falha ao enviar arquivo");
           
        }
        if ($arquivo['size'] > 52428800) {
            die("Arquivo muito grande! Max: 50MB");
        }
        $pasta = "../../arquivos/";
        $nomeDoArquivo = $arquivo['name'];
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

        if ($extensao != "jpg" && $extensao != 'png') {
            die("Tipo de arquivo não aceito");
        }
        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
        $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);

        if ($deu_certo) {
            // Atualiza os dados no banco de dados, incluindo o arquivo
            $query = "UPDATE tb_Funcionario 
                      SET path='$path', data_upload=NOW() 
                      WHERE id_Funcionario='$id_func'";
            $resultado = mysqli_query($con, $query);

            if (!$resultado) {
                die("Erro na query: " . mysqli_error($con));
            }
            echo "<script>alert('Sucesso')</script>";
            // Atualiza o caminho da imagem para exibir a nova imagem
            $pathImagem = $path;
        } else {
            echo "<script>alert('Falha no envio')</script>";
        }
    }
    ?>

    <header>
        <a href="../Telas_Iniciais/index.php"><img src="../../imagens/logo.png" class="logo"></a>
        <nav>
            <ul>
                <li>   <?php 
        if($id_func == 1){
        echo"<span class='texto-com-borda'><a href='http://localhost/TCC/Telas/FluxoADM/TelaInicialADM.php'>HOME </a></span>";
        } else{
          echo"<span class='texto-com-borda'><a href='http://localhost/TCC/Telas/FluxoFuncionario/TelaInicialFuncionario.php'>HOME </a></span>"; 
        }?></li>
            </ul>
        </nav>
    </header>

    <!-- imagem de fundo -->
    <main style="position: relative; height: 100vh;">
        <img src="../../imagens/back.jpg"
            style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;" alt="Sua Imagem"
            class="imagem-escura">
    </main>

    <!--inicio quadrado centro formulario de alteração dos funcionarios-->
    <div class="quadrado-arredondado-geral-horario">
        <!-- div do quadrado preto de fundo -->
        <div class="centro-quadrado-geral center-container">
            <!-- div feita para colocar elementos no meio do quadrado -->

            <!-- Container Flex -->
            <div class="container-flex">
                <!-- Formulário de envio de imagens -->
                <div class="image-upload-section">
                    <h1 class="texto_grande">Perfil de <?php echo htmlspecialchars($nome); ?></h1>
                    <div class="botao-superior-direito">
                    <?php 
  if($id_func == 1){
   echo"<a href='http://localhost/TCC/Telas/FluxoADM/TelaInicialADM.php'><img src='http://localhost/TCC/imagens/seta.png'></a>";
  }else{

    echo"<a href='http://localhost/TCC/Telas/FluxoFuncionario/TelaInicialFuncionario.php'><img src='http://localhost/TCC/imagens/seta.png'></a>";
  }
  ?></div>

                    <img src="<?php echo htmlspecialchars($pathImagem); ?>" alt="Imagem de Perfil" class="profile-image">

                    <form method="POST" enctype="multipart/form-data" action="">
                        <label for="file-upload" class="btn btn-outline-light subpfp">Selecione o arquivo</label>
                        <input id="file-upload" name="arquivo" type="file">
                        <button type="submit" class="btn btn-outline-light subpfp">Enviar arquivo</button>
                    </form>
                </div>

                <!-- Formulário de alteração de dados -->
                
                <div class="form-section">
                    <form action="../arquivos_Alterar/AlteraSenha.php" method="POST" id="formPerfil">
                    <h3 class="info">Informação do usuário:</h3>
                        <div class="form-row">
                            
                        <input type="text" id="id" name="id" placeholder="id" value="<?php echo $id_func?>"
                        class="d-none">
                        
                            <div class="form-group col-md-6">
                                <div class="input-control">
                                    
                                <label for="NomeCliente">Nome </label>
                                        <input type="text" id="NomeCliente" name="NomeCliente" readonly
                                            placeholder="Nome do Cliente" value="<?php echo $nome?>">
                                        <div class="error"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-control">
                                    <label for="TelCliente">Telefone</label>
                                    <input type="text" id="TelCliente" name="TelCliente" readonly
                                        placeholder="Telefone" value="<?php echo $telefone?>">
                                        <div class="error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-control">
                                    <label for="Login">Login</label>
                                    <input type="text" id="Login" name="Login" placeholder="Login" readonly
                                        value="<?php echo $login?>">
                                        <div class="error"></div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-control">
                                    <label for="cpf">CPF</label>
                                    <input type="text" id="cpf" name="cpf"
                                        placeholder="CPF" value="<?php echo $cpf?>" readonly>
                                        <div class="error"></div>
                                </div>
                            </div>
                        </div>

                        <h3 class="info">Alterar senha:</h3>
                        <div class="form-rows">      
                            <div class="form-group col-md-6">
                                <div class="input-control">
                                    <label for="senhaAtual">Senha Atual</label>
                                    <input type="text" id="senhaAtual" name="senhaAtual" placeholder="Senha Atual">
                                    <div class="error"></div>
                                </div>
                            </div></div><div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-control">
                                    <label for="senhaNova">Senha Nova</label>
                                    <input type="text" id="senhaNova" name="senhaNova" placeholder="Senha Nova">
                                    <div class="error"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-control">
                                    <label for="senhaNova2">Repita a senha</label>
                                    <input type="text" id="senhaNova2" name="senhaNova2" placeholder="Repita a senha">
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>

                        <input type="submit" value="Alterar" class="btn btn-outline-success sub btnleft" id="botaoAlterar">
                    </form>
                </div>
            </div>
            <!-- Fim do container flex -->

        </div>
    </div>
    <!-- fim quadrado centro -->
     
    <footer class="footerhome">
        <p class="rodape">Centro Paula Souza - Etec Philadelpho Gouvêa Netto</p>
    </footer>
    <!-- Não mexer, essencial para o bootstrap funcionar -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   
    

<script src="../../js/validacoes/validaAlterarSenha.js"></script>
</body>

</html>