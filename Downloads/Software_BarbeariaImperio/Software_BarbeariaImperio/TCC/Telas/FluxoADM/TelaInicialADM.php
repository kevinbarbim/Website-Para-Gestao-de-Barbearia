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
<?php
            $host='localhost';
            $db='bd_tcc';
            $username='root';
            $password='';
 
            $dsn= "mysql:host=$host;dbname=$db";
            ?>
 
<!doctype html>
<html>
 
<head>
    <title>Barbearia TCC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS Não mexer-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- logo marca -->
    <link rel="icon" href="../../imagens/icon.png" width="50" height="50">
    <!-- relação com o css individual -->
    <link rel="stylesheet" href="../../css/estilo.css" type="text/css">
<style>
   .table-container {
       width: 100%;
       margin: 20px auto;
       overflow: hidden;
       padding: 0;
   }
 
   table {
       width: 100%;
       border-collapse: collapse;
       table-layout: auto;
       color: white;
       font-size: 20px;
   }
 
   td{
       padding: 8px 24px;
       border: 1px solid #fff;
       text-align: left;
       word-wrap: break-word;
   }
  th {
       padding: 10px 24px;
       border: 3px solid #fff;
       text-align: left;
       word-wrap: break-word;
   }
 
   th {
       background-color: #4e4e4e;
       color: #fff;
       font-size: 25px;
       text-align: left;
       padding: 11.5px 28px;
       position: sticky;
       top: 0;
       z-index: 2;
   }
 
 
   tbody tr:hover {
       background-color: #161616;
   }
 
   .scrollable-tbody {
       display: block;
       max-height: 240px;
       overflow-y: auto;
       width: 100%;
   }
 
   .scrollable-tbody tr, thead tr {
       display: table;
       width: 100%;
       table-layout: fixed;
   }
 
   thead {
       width: 100%;
       table-layout: fixed;
   }
 
   tbody {
       width: 100%;
       table-layout: fixed;
   }
 
 
   .scrollable-tbody::-webkit-scrollbar {
       width: 6px;
       
   }
 
   .scrollable-tbody::-webkit-scrollbar-thumb {
    background-color: #fff;
   }
 
   table {
       overflow-x: hidden;
   }
</style>
 
 
 
 
</head>
 
<body>
 
 
    <header style="display: flex; justify-content: space-between; align-items: center;">
        <a href="../Telas_Iniciais/index.php"><img src="../../imagens/logo.png" class="logo"></a>
 
        <div style="display: flex; align-items: center;">
            <nav>
                <ul style="list-style: none; margin: 0; padding: 0; margin-right: 10px;">
                    <li>
                        <?php echo($_SESSION['nome']); ?>
                    </li>
                </ul>
            </nav>
 
            <img src="<?php echo $pathImagem; ?>" alt="Imagem de Perfil"
                style="width: 60px; height: 60px; border-radius: 50%; margin-right: 10px;">
 
            <div class="btn-group">
                <button type="button" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Menu
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" type="button" href="TelaPerfil.php">Perfil</a>
                    <a class="dropdown-item" type="button" href="../../sair.php">Desconectar</a>
                </div>
            </div>
        </div>
    </header>
 
 
 
 
    <!-- imagem de fundo -->
    <main style="position: relative; height: 100vh;">
        <img src="../../imagens/back.jpg"
            style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;" alt="Sua Imagem"
            class="imagem-escura">
    </main>
    <!-- início quadrado esquerda -->
    <div class="quadrado-arredondado-geral">
        <div class="centro-quadrado-fino">
            <a href="Agendamento_Horario.php"><button type="button" class="buttonadm btn btn-outline-light">AGENDAR
                    HORARIO</button></a>
            <a href="../Estoque/TelaDecisaoEstoque.php"><button type="button"
                    class="buttonadm btn btn-outline-light">ESTOQUE</button></a>
            <a href="TelaDecisaoFuncionario.php"><button type="button"
                    class="btn btn-outline-light buttonadm">FUNCIONARIOS</button></a>
            <a href="../Cliente/TelaDecisaoCliente.php"><button type="button"
                    class="btn btn-outline-light buttonadm">CLIENTES</button></a>
        </div>
    </div>
 
 
    <!-- início quadrado listagem de horários central, parte do php e banco -->
    <div class="quadrado-arredondado-geral-listagem">
        <div class="centro-quadrado-fino">
 
            <h1 class="texto_grande">Serviços agendados</h1>
            <label for="filtro" style="font-size:27px; color:white;">Pesquisar por:</label>
               
 
            <form id="procurarCliente" >
           
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input class="form-control" id="FuncProcurado" type="text" name="funcionario"
                            placeholder="Funcionário">
                    </div>
                    <div class="form-group col-md-4">
                        <input class="form-control" id="clienteProcurado" type="text" name="cliente"
                            placeholder="Cliente">
                    </div>
                    <div class="form-group col-md-2">
                        <input class="form-control" id="dataProcurado" type="date" name="datatxt" placeholder="Data">
                    </div>
                    <div class="form-group col-md-2">
                    <input type="submit" value="Limpar"  class="btn btnlimpa">
                   
                 </div>
                </div>
                <br>
 
               
 
            </form>
         
            <div id="results">
 
                <?php
                        // a string do sql tem desc para os desativados (status = 0) ficarem em baixo =)
                     function dataBrPhp($date) {
                     return date('d/m/Y', strtotime($date));
                    }
                    function tempoBrPhp($time) {
                        // Cria um objeto DateTime para formatar o horário
                        $dateTime = new DateTime($time);
                        return $dateTime->format('H:i');
                    }
                    function formatarValor($valor) {
   
                        $valor = trim($valor);
                       
                       
                        $valor = str_replace(',', '.', $valor);
                       
                       
                        if (strpos($valor, '.') === false) {
                       
                            $valor .= '.00';
                        } else {
                       
                            $valor = number_format((float)$valor, 2, '.', '');
                        }
                       
                        return $valor;
                    }
                            try{
                                $conn=new PDO($dsn,$username,$password);
                                $results=[];
                                if($conn){
                                    $query=$conn->prepare('SELECT s.id_Servico, f.Nome_Funcionario, c.Nome_Cliente, s.Data_Servico, s.Horario_Servico, s.Metodo_Pagamento, s.Valor_Total
                                    FROM tb_servico s
                                    JOIN tb_funcionario f ON (cod_funcionario=id_funcionario)
                                    JOIN tb_cliente c ON (cod_cliente=id_cliente)
                                    WHERE s.status=1 order by data_servico');
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_ASSOC);
                                }
                                echo"<div class='table-container'> <table>  <thead class='head2'> <tr><th>Barbeiro</th><th>Cliente</th><th>Data</th><th>Horário</th><th>Total</th><th>Alterar</th><th>Baixa</th></tr></thead><tbody class='scrollable-tbody'>";
                                foreach($results as $result): ?>
                <tr class="textos_cima_label">
                    <?php  $id=$result['id_Servico']?>
                    <td>
                        <?= $result['Nome_Funcionario']?>
                    </td>
                    <td>
                        <?= $result['Nome_Cliente']?>
                    </td>
                    <td>
                        <?= dataBrPhp($result['Data_Servico'])?>
                    </td>
                    <td>
                        <?= tempoBrPhp($result['Horario_Servico'])?>
                    </td>
                 
                    <td>
                        <?= formatarValor($result['Valor_Total'])?>
                    </td>
                    <td class="centroCelula"><a href='../arquivos_Alterar/Frm_Altera_Horario.php?id=<?php echo $id ?>'> <img src='../../imagens/editar.png' height='50px'></a></td>
                            <td class="centroCelula"><a href='../sistema_Baixa/Frm_Baixa.php?id=<?php echo $id ?>'> <img src='../../imagens/excluir.png' height='50px'> </a></td>
 
                </tr>
                <?php endforeach;
                                echo'</tbody></table></div>';
 
                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }
                       
                        ?>
 
            </div>
        </div>
    </div>
    <footer class="footerhome">
        <p class="rodape">Centro Paula Souza - Etec Philadelpho Gouvêa Netto</p>
    </footer>
 
 
    <script> //script chama php complementar, que faz uma varredura no banco a procura de entidades com nome parecido
        //após isto, retorna um array em formato json para este script interpretar e transformar em tabela
       
 
        const elementoProcurado = document.getElementById('FuncProcurado');
        const elementoProcurado2 = document.getElementById('clienteProcurado');
        const elementoProcurado3 = document.getElementById('dataProcurado');
        const resultsElem = document.getElementById('results');
        function dataBr(dateString) {
                const [year, month, day] = dateString.split('-');
                return `${day}/${month}/${year}`;
            }
        function tempoBr(timeString) {
                const [hour, minute] = timeString.split(':');
                return `${hour}:${minute}`;
            }
 
 
 
        elementoProcurado.addEventListener('keyup', () => {
            const value = elementoProcurado.value;
 
            fetch(` http://localhost/TCC/Telas/phpComplementar/inicialADMprocuraFuncionario.php?cliente=${value}`)
                .then(response => response.json())
                .then(results => {
                    let resultsHTML = "<div class='table-container'> <table>  <thead class='head2'> <tr><th>Barbeiro</th><th>Cliente</th><th>Data</th><th>Horário</th><th>Total</th><th>Alterar</th><th>Baixa</th></tr></thead><tbody class='scrollable-tbody'>";
                    results.forEach(item => {
                        resultsHTML += `  
                        <tr class="textos_cima_label">
                            <td>${item.Nome_Funcionario}</td>
                            <td>${item.Nome_Cliente}</td>
                            <td>${dataBr(item.Data_Servico)}</td>
                            <td>${tempoBr(item.Horario_Servico)}</td>
     
                            <td>${parseFloat(item.Valor_Total).toFixed(2)}</td>
                           
                            <td class='centroCelula'><a href='../arquivos_Alterar/Frm_Altera_Horario.php?id=${item.id_Servico}'> <img src='../../imagens/editar.png' height='50px'></a></td>
                            <td class='centroCelula'><a href='../sistema_Baixa/Frm_Baixa.php?id=${item.id_Servico}'> <img src='../../imagens/excluir.png' height='50px'> </a></td>
                            </tr>`;
                    });
                    resultsHTML += '</tbody></table></div>';
                    resultsElem.innerHTML = resultsHTML;
                });
        });
 
        elementoProcurado2.addEventListener('keyup', () => {
            const value = elementoProcurado2.value;
 
            fetch(` http://localhost/TCC/Telas/phpComplementar/inicialADMprocuraCliente.php?cliente=${value}`)
                .then(response => response.json())
                .then(results => {
                    let resultsHTML = "<div class='table-container'> <table>  <thead class='head2'> <tr><th>Barbeiro</th><th>Cliente</th><th>Data</th><th>Horário</th><th>Total</th><th>Alterar</th><th>Baixa</th></tr></thead><tbody class='scrollable-tbody'>"; results.forEach(item => {
                        resultsHTML += `  
                         <tr class="textos_cima_label">
                           
                       
                            <td>${item.Nome_Funcionario}</td>
                            <td>${item.Nome_Cliente}</td>
                            <td>${dataBr(item.Data_Servico)}</td>
                            <td>${tempoBr(item.Horario_Servico)}</td>
                           
                            <td>${parseFloat(item.Valor_Total).toFixed(2)}</td>
                           
                            <td class='centroCelula'><a href='../arquivos_Alterar/Frm_Altera_Horario.php?id=${item.id_Servico}'> <img src='../../imagens/editar.png' height='50px'></a></td>
                            <td class='centroCelula'><a href='../sistema_Baixa/Frm_Baixa.php?id=${item.id_Servico}'> <img src='../../imagens/excluir.png' height='50px'> </a></td>
                            </tr>`;
                    });
                    resultsHTML += '</tbody></table></div>';
                    resultsElem.innerHTML = resultsHTML;
                });
        });
 
        elementoProcurado3.addEventListener('change', () => {
            const value = elementoProcurado3.value;
            console.log(value);
            fetch(` http://localhost/TCC/Telas/phpComplementar/inicialADMprocuraData.php?cliente=${value}`)
                .then(response => response.json())
                .then(results => {
                    let resultsHTML = "<div class='table-container'> <table>  <thead class='head2'> <tr><th>Barbeiro</th><th>Cliente</th><th>Data</th><th>Horário</th><th>Total</th><th>Alterar</th><th>Baixa</th></tr></thead><tbody class='scrollable-tbody'>";  results.forEach(item => {
                        resultsHTML += `  
                         <tr class="textos_cima_label">
                           
                       
                            <td>${item.Nome_Funcionario}</td>
                            <td>${item.Nome_Cliente}</td>
                            <td>${dataBr(item.Data_Servico)}</td>
                            <td>${tempoBr(item.Horario_Servico)}</td>
                         
                            <td>${parseFloat(item.Valor_Total).toFixed(2)}</td>
                           
                            <td class='centroCelula'><a href='../arquivos_Alterar/Frm_Altera_Horario.php?id=${item.id_Servico}'> <img src='../../imagens/editar.png' height='50px'></a></td>
                            <td class='centroCelula'><a href='../sistema_Baixa/Frm_Baixa.php?id=${item.id_Servico}'> <img src='../../imagens/excluir.png' height='50px'> </a></td>
                            </tr>`;
                    });
                    resultsHTML += '</tbody></table></div>';
                    resultsElem.innerHTML = resultsHTML;
                });
        });
 
 
 
 
    </script>
 
    <!-- Não mexer, essencial para o bootstrap funcionar -->
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
</body>
 
</html>