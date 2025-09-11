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
    <title> Altera Horário</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
<!-- Bootstrap CSS Não mexer-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- logo marca -->
<link rel="icon" href="../imagens/icon.png" width="50" height="50">

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
  
<?php

/*1- realizando a conexao com o banco de dados (local, usuario,senha,nomeBanco)*/
$con=mysqli_connect("localhost","root","","bd_TCC");

/*2- pegando o valor vindo da url */
$id_servico=$_GET["id"];

/*3- criando o comando sql para listar os dados do cliente selecionado */
$comandoSql="SELECT s.*, c.Nome_Cliente
FROM tb_servico s JOIN tb_cliente c
ON (cod_cliente=id_cliente)
WHERE id_Servico ='$id_servico'";

/*4- executando o comando sql */
$resultado=mysqli_query($con, $comandoSql);

/*5- pegando os dados da consulta criada e armazenando em variaveis */

$dados=mysqli_fetch_assoc($resultado);

$cod_Cliente=$dados["cod_Cliente"];
$data=$dados["Data_Servico"];
$horario=$dados["Horario_Servico"];
$valorBanco=$dados["Valor_Total"];
$feito=$dados["Descricao_Corte"];
$funcionario=$dados["cod_Funcionario"];
$pagamento=$dados["Metodo_Pagamento"];
$tags=$dados["tags"];



?>


<?php 
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

  


<!-- inicio do quadrado de alterar -->
<div class="quadrado-arredondado-geral-horario center-container">
  <div class="container-flex">
    <!-- div do quadrrado preto de fundo-->
    <div class="centro-quadrado-geral">
      <!-- div feita para colocar elementos no meio do quadrado-->

      <h1 class="texto_grande" style="margin-top:15px">Agendamento de horário</h1> <!-- cabeçario -->
      
      <div class="botao-superior-direito"> <?php 
  if($id_func == 1){
   echo"<a href='http://localhost/TCC/Telas/FluxoADM/TelaInicialADM.php'><img src='http://localhost/TCC/imagens/seta.png'></a>";
  }else{

    echo"<a href='http://localhost/TCC/Telas/FluxoFuncionario/TelaInicialFuncionario.php'><img src='http://localhost/TCC/imagens/seta.png'></a>";
  }
  ?></div>

      <br>
      <div class="textos_cima_label">
        <form action="Alterar_Horario.php" method="POST"  id="formAgendaHorario">
          <!-- inicio do formulario de cadastro do horario do atendimento-->

          <div class="form-row">

          <input type="text" class="form-control d-none" id="id" name="id" value="<?php echo $id_servico?>" placeholder="Nome do Cliente" readonly>
                 
            <div class="form-group col-md-4">
            <?php  lista_Cliente_Cod($cod_Cliente);  ?>	
            </div>
            <div class="form-group col-md-4">
            <?php  lista_Func_cod($funcionario);  ?>	
          
            </div>
            <div class="form-group col-md-4">
                <div class="input-control" style="margin-top:-20px">
                  <label for="SelectPagamento">Pagamento</label>
                  <select class="form-control" id="SelectPagamento"  style="height:55px; 	font-size: 21px;"  name="SelectPagamento">
                         <option value="PIX" <?php if($pagamento=='PIX') echo "selected"?>>PIX</option>
                         <option value="DINHEIRO" <?php if($pagamento=='DINHEIRO') echo "selected"?>>DINHEIRO</option>
                         <option value="CRÉDITO" <?php if($pagamento=='CRÉDITO') echo "selected"?>>CRÉDITO</option>
                         <option value="DÉBITO" <?php if($pagamento=='DÉBITO') echo "selected"?>>DÉBITO</option>
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
                  <input type="text" class="form-control" id="Horario" name="Horario" value="<?php echo $horario?>"
                    placeholder="00:00">
                  <div class="error"></div>
                </div>
              </div>

              <div class="form-group col-md-4">
                <div class="input-control">
                  <label for="valor">Valor Total</label>
                  <input type="text" class="form-control" id="valor" name="valor" placeholder="000.00" value="<?php echo formatarValor($valorBanco) ?>">
                  <div class="error"></div>
                </div>
              </div>

              <div class="form-group col-md-4">
                <div class="input-control">
                  <label for="textoData">Data</label>
                  <input type="date" class="form-control" id="textoData" name="textoData"
                  value="<?php echo $data?>">
                  <div class="error"></div>
                </div>
              </div>
            </div>

          </div>

          <div class="form-group">

            <div class="form-row">

              

              <div class="form-group col-md-8">
                <div class="input-control">
                  <label for="validationDefault01">O que será feito</label>
                  <input type="text" class="form-control" id="Feito" name="Feito" placeholder="O que será feito" value="<?php echo $feito?>">
                  <div class="error"></div>
                </div>
              </div>


                            <?php
                           
                            $tagsArray = $tags ? explode(' / ', $tags) : array();

                            ?>


              <div class="checkbox-group">
              <label for="checkbox-group">Tipo de serviço</label> <br>
              <div class="container2">
            <label>
                <input type="checkbox" name="servicos[]" value="corte-simples" <?php if (in_array('corte-simples', $tagsArray)) echo 'checked'; ?>>
                Corte Simples
            </label>
            <label>
                <input type="checkbox" name="servicos[]" value="corte-elaborado" <?php if (in_array('corte-elaborado', $tagsArray)) echo 'checked'; ?>>
                Corte Elaborado
            </label>
            <label>
                <input type="checkbox" name="servicos[]" value="barba" <?php if (in_array('barba', $tagsArray)) echo 'checked'; ?>>
              Barba 
            </label>
            <label>
                <input type="checkbox" name="servicos[]" value="luzes" <?php if (in_array('luzes', $tagsArray)) echo 'checked'; ?>>
               Luzes
            </label>
            <label>
                <input type="checkbox" name="servicos[]" value="tintura" <?php if (in_array('tintura', $tagsArray)) echo 'checked'; ?>>
                Tintura
            </label>
        </div>

</div>
            </div>


            <div class="form-row">
            <div style="text-align:left">
                        <input type="submit" value="ALTERAR" class="btn btn-outline-success sub" id="botaoLogar">
                  </div>
                  <br>
                  <div style="text-align:right">
                       <?php echo"<a href='../arquivos_Excluir/Excluir_Horario.php?id=$id_servico' class='btn btn-outline-danger sub' id='botaoExcluir'>EXCLUIR</a>" ?>
                  </div>
            </div>
          </div>

         

        </form><!-- fim do formulario de cadastro do horario do atendimento-->
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
    $('#valor').mask("000.00", { reverse: true });

   $(document).ready(function() {
   
    $('#Cliente').select2({
        width: '100%' 
    });

    if(id_func_js != 1){
      document.getElementById("Funcionario").style.pointerEvents = "none";

    }
   });
   
  </script>

<script>
var botao = document.getElementById('botaoExcluir');
 
botao.addEventListener('click', function(e) {
    var resultado = confirm("Realmente deseja excluir este agendamento?");
    if (!resultado) {
        e.preventDefault(); // Impede que o link seja acionado se a confirmação for cancelada
    }
});
</script>

  </body>


</html>



