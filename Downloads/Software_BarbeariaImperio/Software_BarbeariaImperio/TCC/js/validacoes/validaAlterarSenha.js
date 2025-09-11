//seta classes que vao colorir as labels

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');
};

// Define a caixa como verde se tudo estiver certo com o elemento
const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};


/*seta classe, que precisa ser assync para a comunicação js e ajax, que 
vai no banco e ve se tem algum item de mesmo nome, so que de id diferente, se sim ele retorna como falso*/
async function validaSenhaBanco() {
    return new Promise((resolve, reject) => {

        const senhaBanco = { e: $('#senhaAtual').val().trim(),
                             s: $('#id').val().trim()};
        const dados = JSON.stringify(senhaBanco);

//manda pro pesquisa

        $.ajax({
            url: '../../Telas/phpComplementar/pesquisaSenhaBanco.php',
            type: 'POST',
            data: { data: dados },
            dataType: "json",
            success: function (result) {
                if (result.status === "failed") {
                    resolve(false); // Telefone já cadastrado
                } else {
                    resolve(true); // Telefone não cadastrado
                }
            },
            error: function (errorMessage) {
                reject(errorMessage); // Rejeitar  em caso de erro, n vai aparecer
            }
        });
    });
}

//chama essa funcao quando o botao for clicado
$(document).ready(function() {
    $('#botaoAlterar').click(async function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário
        
        //pega os elementos do campo
  
        const SenhaAtual = document.getElementById('senhaAtual');
        const SenhaNova = document.getElementById('senhaNova');
        const SenhaNova2 = document.getElementById('senhaNova2');
 
    
     
    
        //variaveis auxiliares para comprovar a validacao
     
        let SenhaAtualTrue = false;
        let SenhaNovaTrue = false;
        let SenhaNova2True = false;
        
     
        //comeco real das validacoes, se tiver uma errada form nao avança


        if ($('#senhaAtual').val() === "") {
            setError(SenhaAtual, 'Digite sua senha');
        } else {
            try {
                SenhaAtualTrue = await validaSenhaBanco();
                if (SenhaAtualTrue) {
                    setSuccess(SenhaAtual);
                } else {
                    setError(SenhaAtual, 'Senha Incorreta');
                }
            } catch (error) {
                alert("Erro: " + error);
                setError(SenhaAtual, 'Erro ao validar senha');
            }
        }



        if ($('#senhaNova').val() === "") {
            setError(SenhaNova, 'Digite a senha nova');
          } else if ($('#senhaNova2').val() != $('#senhaNova').val()) {
            setError(SenhaNova, 'As senhas devem ser iguais');
            
          } else {
            setSuccess(SenhaNova);
            SenhaNovaTrue = true;
        }

        
        if ($('#senhaNova2').val() === "") {
            setError(SenhaNova2, 'Digite a senha nova');
          } else if ($('#senhaNova2').val() != $('#senhaNova').val()) {
            setError(SenhaNova2, 'As senhas devem ser iguais');
          } else {
            setSuccess(SenhaNova2);
            SenhaNova2True = true;
        }
   
       



    
        


        //se todas as auxiliares forem verdadeiras, eu permito que o form seja enviado (submitado)
        if (SenhaAtualTrue==true && SenhaNova2True == true && SenhaNovaTrue == true) {

            $('#formPerfil').submit();

        } else {
            //se nao, o return false faz ele ficar na guia, e exibe o erro
            return false;
        }
    });
});


