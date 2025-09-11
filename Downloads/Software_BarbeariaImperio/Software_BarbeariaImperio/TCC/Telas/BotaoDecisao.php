<?php
session_start();

    // Pegando os dados vindos do formulário e armazenando em variáveis
    $usuario =$_POST["LoginFuncionario"];
    $senha =$_POST["SenhaFuncionario"];

    $comandoSql2="select * from tb_funcionario where login='$usuario' and senha='$senha'";

    // Executando o comando SQL
    $con2=mysqli_connect("localhost","root","","bd_TCC");
    $resultado2 = mysqli_query($con2, $comandoSql2);

  

    // Verificando se o comando SQL retornou algum registro

    if (mysqli_num_rows($resultado2) > 0 ) {
        // Credenciais corretas, iniciar a sessão do usuário
        $_SESSION['user'] = $usuario; // Armazenar o email do usuário na sessão
        $_SESSION['senha'] = $senha; // Armazenar o tipo de usuário na sessão

        $dados2=mysqli_fetch_assoc($resultado2);

        $_SESSION['id'] = $dados2["id_Funcionario"];
        $_SESSION['nome'] = $dados2["Nome_Funcionario"];

       if($_SESSION['id']==1){
        header('Location: FluxoADM/TelaInicialADM.php');
       }else{
        header('Location: FluxoFuncionario/TelaInicialFuncionario.php');
       }

 
    } else{
     unset ($_SESSION['user']);
     unset ($_SESSION['senha']);
     header('Location: Telas_Iniciais/login.php?');

  }
    
  
?>