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
    <title>Funcionários ativos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS Não mexer -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- logo marca -->
    <link rel="icon" href="../../imagens/icon.png" width="50" height="50">

    <!-- relação com o css individual -->
    <link rel="stylesheet" href="../../css/estilo.css" type="text/css">      
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

    <!-- imagem de fundo -->
    <main style="position: relative; height: 100vh;">
        <img src="../../imagens/back.jpg" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;" alt="Sua Imagem" class="imagem-escura">
    </main>

    <!-- inicio quadrado listagem -->
    <div class="quadrado-arredondado-geral-listagem-funcAtv">           <!-- div do quadrado preto de fundo -->
        <div class="centro-quadrado-fino">                        <!-- div feita para colocar elementos no meio do quadrado -->

            <?php
            $host='localhost';
            $db='bd_tcc';
            $username='root';
            $password='';

            $dsn= "mysql:host=$host;dbname=$db";
            ?>    

            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <h1 class="texto_grande">Procurar Funcionário</h1>
               
                        <form id="procurarFuncionario" method="GET" action="ListagemFuncionariosAtivos.php">
                            <input class="form-control" id="funcionarioProcurado" type="text" name="funcionario" placeholder="Nome do funcionário">   
                            <button class=" btn btn-outline-light buttonadm3 btn-block ">Procurar</button>
                        </form>
                    </div>         <div class="botao-superior-direito">  <?php 
             echo"<a href='http://localhost/TCC/Telas/FluxoADM/TelaDecisaoFuncionario.php'><img src='http://localhost/TCC/imagens/seta.png'></a>";
            ?></div>
                    <div class="col-8" id="results"><br>
                        <?php 
                        // a string do sql tem desc para os desativados (status = 0) ficarem em baixo =)
                        if(isset($_GET['funcionario'])){
                            try{
                                $conn=new PDO($dsn,$username,$password);
                                $results=[];
                                if($conn){
                                    $query=$conn->prepare('select * from tb_Funcionario where Nome_Funcionario like ? order by Status desc');
                                    $query->execute(array("%" . $_GET['funcionario'] . "%" ??''));
                                    $results=$query->fetchAll(PDO::FETCH_ASSOC);
                                }
                                echo'<table class="table table-striped">   <tr class="textos_cima_label"><th>Nome</th><th>Telefone</th><th>CPF</th><th>Status</th><th>Relatório</th></tr>';
                                foreach($results as $result): ?>
                                
                                    <tr class="textos_cima_label">
                                        <?php  $id=$result['id_Funcionario'] ?>
                                        <td><?= $result['Nome_Funcionario']?></td>
                                        <td><?= $result['Telefone_Funcionario']?></td>
                                        <td><?= $result['CPF_Funcionario'] ?></td>
                                        <td><?php
                                                        if ($result['Status'] == 1) {
                                                                       
                                                                      echo "<img src='../../imagens/ativo.png' height='50px' alt='Ativo'>";
                                                        } else {
                                                                     
                                                                       echo "<img src='../../imagens/inativo.png' height='50px' alt='Inativo'>";
                                                        }
                                        ?></td>
                                        <td><a href='../arquivos_Alterar/Frm_Alterar_Funcionario.php?id=<?php echo $id ?>'> <img src='../../imagens/editar.png' height='50px' > </a></td>
                                    </tr>
                                <?php endforeach;
                                echo'</table>';

                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }
                        }else{
                            try{
                                $conn=new PDO($dsn,$username,$password);
                                $results=[];
                                if($conn){
                                    $query=$conn->prepare('select * from tb_Funcionario order by Status desc');
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_ASSOC);
                                }
                                echo'<table class="table table-striped">   <tr class="textos_cima_label"><th>Nome</th><th>Telefone</th><th>CPF</th><th>Status</th><th>Relatório</th></tr>';
                                foreach($results as $result): ?>
                                    <tr class="textos_cima_label">
                                        <?php  $id=$result['id_Funcionario']?>
                                        <td><?= $result['Nome_Funcionario']?></td>
                                        <td><?= $result['Telefone_Funcionario']?></td>
                                        <td><?= $result['CPF_Funcionario']?></td>

                                        <td><?php
                                                        if ($result['Status'] == 1) {
                                                                       
                                                                      echo "<img src='../../imagens/ativo.png' height='50px' alt='Ativo'>";
                                                        } else {
                                                                     
                                                                       echo "<img src='../../imagens/inativo.png' height='50px' alt='Inativo'>";
                                                        }
                                        ?></td>

                                        <td><a href='../arquivos_Alterar/Frm_Alterar_Funcionario.php?id=<?php echo $id ?>'> <img src='../../imagens/editar.png' height='50px'> </a></td>
                                    </tr>
                                <?php endforeach;
                                echo'</table>';

                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div> <!-- Fechar div .quadrado-arredondado-geral-listagem-funcAtv -->
    </div> <!-- Fechar div .centro-quadrado-fino -->

    <footer class="footerhome">
        <p class="rodape">
         Centro Paula Souza - Etec Philadelpho Gouvêa Netto
        </p>
    </footer>	

    <script> //script chama php complementar, que faz uma varredura no banco a procura de entidades com nome parecido
            //após isto, retorna um array em formato json para este script interpretar e transformar em tabela
     const elementoProcurado = document.getElementById('funcionarioProcurado');
        const resultsElem = document.getElementById('results');
        elementoProcurado.addEventListener('keyup', () => {
            const value = elementoProcurado.value;
           
            fetch(` http://localhost/TCC/Telas/phpComplementar/funcionariosProcurar.php?funcionario=${value}`)
                .then(response => response.json())
                .then(results => {
                    let resultsHTML = '<table class="table table-striped">   <tr class="textos_cima_label"><th>Nome</th><th>Telefone</th><th>CPF</th><th>Status</th><th>Relatório</th></tr>';
                    results.forEach(item => {

                        const statusImagem = item.Status == '1'
                        ? '<img src="../../imagens/ativo.png" height="50px">'
                        : '<img src="../../imagens/inativo.png" height="50px">';

                        resultsHTML += `  
                         <tr class="textos_cima_label">
                            
                        
                            <td>${item.Nome_Funcionario}</td>
                            <td>${item.Telefone_Funcionario}</td>
                            <td> ${item.CPF_Funcionario}</td>
                            <td>${statusImagem}</td>
                            <td><a href='../arquivos_Alterar/Frm_Alterar_Funcionario.php?id=${item.id_Funcionario}'> <img src='../../imagens/editar.png' height='50px'> </a></td>
                        </tr>`;
                    });
                    resultsHTML += '</table>';
                    resultsElem.innerHTML = resultsHTML;
                });
        });
</script>

    <!-- Não mexer, essencial para o bootstrap funcionar -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
