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

  <title>Novo serviço</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS Não mexer-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!-- logo marca -->
  <link rel="icon" href="../../imagens/icon.png" width="50" height="50">

  <!--relação com o css individual-->
  <link rel="stylesheet" href="../../css/estilo.css" type="text/css">

<style>
.container2 {
    width: 250px;
    height: 100px;
    border: 1px solid black;
    overflow: auto;
    flex-direction: column;
    display: flex;
    
    text-align: left;
        margin: 0 auto;
}

input[type="checkbox"] {
    vertical-align: middle; /* Garante que a checkbox fique centralizada verticalmente com o texto */
    margin-right: 5px; /* Ajusta o espaço entre a checkbox e o texto */
}


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


.input-control .error {
    position: absolute;
    top: 80%;
    left: 0;
}



.input-control input {
    border: 2px solid #f0f0f0;
	border-radius: 4px;
	display: block;
	font-size: 21px;
	padding: 25px;
	width: 100%;
  
}



.select2-selection {
    height: 55px !important;
    font-size: 21px; 
  padding-top: 10px;
}

</style>
</head>

<body>

  <?php
    //colocar o require do index.php

    require "../ListagemFuncionarios.php";
    
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
        
        <li> 
          <?php 
        if($id_func == 1){
        echo"<span class='texto-com-borda'><a href='http://localhost/TCC/Telas/FluxoADM/TelaInicialADM.php'>HOME </a></span>";
        } else{
          echo"<span class='texto-com-borda'><a href='http://localhost/TCC/Telas/FluxoFuncionario/TelaInicialFuncionario.php'>HOME </a></span>"; 
        }?>
      
      </li>
    </ul>
  </nav>
        </div>
    </div>
</header>

  <!-- imagem de fundo -->
  <main style="position: relative; height: 100vh;">
    <img src="../../imagens/back.jpg"
      style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;" alt="Sua Imagem"
      class="imagem-escura">
  </main>








  <!--inicio quadrado centro formulario de agendamento-->

  <div class="quadrado-arredondado-geral-horario center-container">
  <div class="container-flex">
    <!-- div do quadrrado preto de fundo-->
    <div class="centro-quadrado-geral">
      <!-- div feita para colocar elementos no meio do quadrado-->

      <h1 class="texto_grande" style="margin-top:10px">Agendamento de horário</h1> <!-- cabeçario -->
      <div class="botao-superior-direito"><?php 
  if($id_func == 1){
   echo"<a href='http://localhost/TCC/Telas/FluxoADM/TelaInicialADM.php'><img src='http://localhost/TCC/imagens/seta.png'></a>";
  }else{

    echo"<a href='http://localhost/TCC/Telas/FluxoFuncionario/TelaInicialFuncionario.php'><img src='http://localhost/TCC/imagens/seta.png'></a>";
  }
  ?></div>
      
      <div class="textos_cima_label">
        <form action="../arquivos_Cadastrar/cadastra_horario.php" method="POST" id="formAgendaHorario">
          <!-- inicio do formulario de cadastro do horario do atendimento-->

          <div class="form-row">
          
          <input type="text"  id="id" name="id" placeholder="id" value="0" class="d-none">
          
            <div class="form-group col-md-4">
           
              <?php  lista_Cliente();  ?>
              
            
             </div>
            
            <div class="form-group col-md-4">
           
              <?php 
              
              if($id_func == 1){
              lista_Func(); 
              }else{
                lista_Func_cod($id_func); 
              }
              
              
              ?>
              
           </div>
            <div class="form-group col-md-4">
                <div class="input-control"  style=" margin-top: -22px">
                  
                  <label for="SelectPagamento">Pagamento</label>
                  <select class="form-control" id="SelectPagamento" style="height:55px; 	font-size: 21px;" name="SelectPagamento">
                    <option value="PIX">PIX</option>
                    <option value="DINHEIRO">DINHEIRO</option>
                    <option value="CRÉDITO">CRÉDITO</option>
                    <option value="DÉBITO">DÉBITO</option>
                  </select>
                  <div class="error"></div>
                </div>
              </div>
          </div>

          <div class="form-group">

            <div class="form-row">



              <div class="form-group col-md-4">
                <div class="input-control">
                  <label for="Horario">Horário</label>
                  <input type="text" class="form-control" id="Horario" name="Horario"
                    placeholder="00:00">
                  <div class="error" style="position: absolute;top: 100%; left: 0;"></div>
                </div>
              </div>

              <div class="form-group col-md-4">
                <div class="input-control">
                  <label for="valor">Valor Total</label>
                  <input type="text" class="form-control" id="valor" name="valor" placeholder="000.00">
                  <div class="error" style="position: absolute;top: 100%; left: 0;"></div>
                </div>
              </div>

              <div class="form-group col-md-4">
                <div class="input-control">
                  <label for="textoData">Data</label>
                  <input type="date" class="form-control" id="textoData" name="textoData"
                    min="<?php   date_default_timezone_set('America/Sao_Paulo'); $hoje = date('Y-m-d');    echo($hoje); ?>">
                  <div class="error" style="position: absolute;top: 100%; left: 0;"></div>
                </div>
              </div>
            </div>

          </div>

          <div class="form-group">

            <div class="form-row">

              

              <div class="form-group col-md-8">
                <div class="input-control">
                  <label for="Feito">O que será feito</label>
                  <input type="text" class="form-control" id="Feito" name="Feito" placeholder="O que será feito">
                  <br>
                  <div class="error"></div>
                </div>
              </div>


          
              <div class="checkbox-group">
                
              <label for="checkbox-group">Tipo de serviço</label> <br>
              <div class="container2">
            <label>
                <input type="checkbox" name="servicos[]" value="corte-simples">
                Corte Simples
            </label>
            <label>
                <input type="checkbox" name="servicos[]" value="corte-elaborado">
                Corte Elaborado
            </label>
            <label>
                <input type="checkbox" name="servicos[]" value="barba">
              Barba 
            </label>
            <label>
                <input type="checkbox" name="servicos[]" value="luzes">
               Luzes
            </label>
            <label>
                <input type="checkbox" name="servicos[]" value="tintura">
                Tintura
            </label>
        </div></div>


            </div>
          </div>
          <div class="form-row">
          <div style="text-align:right">
          <input type="submit" value="Cadastrar" class="btn btn-outline-success sub" id="botaoLogar">
            </div><div style="text-align:left">
          <a href="Agendamento_Horario.php"><input type="button" value="Limpar" class="btn btn-outline-danger sub"></a>
            </div></div>
        </form><!-- fim do formulario de cadastro do horario do atendimento-->
        
      </div>

    </div>
  </div></div>
  <!--fim quadrado-->












  <footer class="footerhome">
    <p class="rodape">
      Centro Paula Souza - Etec Philadelpho Gouvêa Netto
    </p>
  </footer>









  <!-- Não mexer, essencial para o bootstrap funcionar-->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script><!-- estes dois sao links do ajax para funcionar-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script><!-- este é o requerimento do bootstrap-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script><!-- este é o link de referencia das mascaras dos campos-->
  <script src="../../js/validacoes/validaCadastroHorario.js"></script> <!-- chama as funcoes de validacoes ajax e js-->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> <!-- link do js externo do select 2, aquele com barra de busca-->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>

    var id_func_js=<?php echo $id_func; ?>;
    

    $('#Horario').mask('00:00');  //codigo para adicionar a mascara nos campos, ja serve como validação pois impede add de letras.
    $('#valor').mask("000.00", { reverse: true }); //função pre pronta do jquery, facilita vidas 

    $(document).ready(function() {
    $('#Cliente').select2({
        width: '100%' // Use 100% para garantir que o select2 ocupe a largura total do elemento pai
    });
   

    if(id_func_js != 1){
      document.getElementById("Funcionario").style.pointerEvents = "none";

    }
 

   });
   
  </script>
 
</body>

</html>