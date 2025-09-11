<?php
// starta os arrays
$caixasSelecionadas = [];

$arrayTextos = [];

$num = $_POST['numero']; // Verifica o número de produtos

// checa se o formulario foi enviado

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // checa quais caixas foram selecionadas
    for ($i = 1; $i <= $num; $i++) {
        if (isset($_POST['checkbox' . $i])) {
            $caixasSelecionadas[] = $_POST['checkbox' . $i];
        }
    }

    // pega os valores de texto
    for ($i = 1; $i <= $num; $i++) {
        $TextoIndividual = isset($_POST['text' . $i]) ? $_POST['text' . $i] : '';
        if ($TextoIndividual !== '') { // Ignora vazios
            $arrayTextos[] = $TextoIndividual;
        }
    }
}

//se nenhuma checkbox foi selecionada, é por que o cliente não comprou nada, entao tem q deixar avançar igual
if (empty($caixasSelecionadas)) {
    header('Location: ../FluxoADM/TelaInicialADM.php');
    exit(); // faz o script parar
}

$con = mysqli_connect("localhost", "root", "", "bd_TCC");



// inicia uma variavel para rastrear erros, tipo as do validaTel 
$erroTrue = false;

// Garante que os dois arrais estejam de mesmo tamanho, pois em seguida iremos tratalos como uma matriz, pegando os valores das colunas
if (count($caixasSelecionadas) !== count($arrayTextos)) {
    die();
}

// Coleta e processa cada checkbox e campo de texto

for ($i = 0; $i < count($caixasSelecionadas); $i++) {

    $checkbox = mysqli_real_escape_string($con, $caixasSelecionadas[$i]);
    $TextoIndividual = mysqli_real_escape_string($con, $arrayTextos[$i]);

    $comandoSql = "INSERT INTO tb_venda_produto (cod_produto, quantidade_produto, cod_servico) VALUES ('$checkbox', '$TextoIndividual', '1')";

    if (!mysqli_query($con, $comandoSql)) {
        $erroTrue = true;
        break; //função igual do switch case
    }
}

// Verifica se houve erro na inserção
if (!$erroTrue) {
    header('Location: ../FluxoADM/TelaInicialADM.php');
    exit(); 
} else {
    echo "erro no cadastro";
}

// encerra conexão com o banco
mysqli_close($con);
?>