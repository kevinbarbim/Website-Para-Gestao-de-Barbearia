//classes de colorir labels

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

//classe que valida se o email é de vdd antes de fazer a pesquisa complexa no banco, auxilia na otimização ja que so pesquisa de vdd se o email realmente existir
const emailValidacaoPronta = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
};


// Função assíncrona que valida o telefone, precisa ser assim para inretação de js e ajax

async function validaEmail() {
    return new Promise((resolve, reject) => {

        const emailBanco = { e: $('#LoginFuncionario').val().trim()

                           };
        const dados = JSON.stringify(emailBanco);

 //vai no pesquisa email, executa, se tiver um chama como falso

        $.ajax({
            url: '../../Telas/phpComplementar/pesquisaEmailLogin.php',
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
async function validaSenha() {
    return new Promise((resolve, reject) => {

        const emailBanco = { e: $('#LoginFuncionario').val().trim(),
                             s: $('#SenhaFuncionario').val().trim()
                           };
        const dados = JSON.stringify(emailBanco);

 //vai no pesquisa senha, executa, se tiver um chama como falso

        $.ajax({
            url: '../../Telas/phpComplementar/pesquisaSenhaLogin.php',
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
    $('#botaoLogar').click(async function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário
        
        //pega os elementos do campo
        const email = document.getElementById('LoginFuncionario');     
        const senha = document.getElementById('SenhaFuncionario');
        
     
    
        //variaveis auxiliares para comprovar a validacao
        let emailTrue = false;
        let senhaTrue = false;
    


        if ($('#LoginFuncionario').val() === "") {
            setError(email, 'Email precisa ser escrito');
        } else if(!emailValidacaoPronta($('#LoginFuncionario').val())){
            setError(email, 'Email inválido');
        }else{
            try {
                emailTrue = await validaEmail();
                if (emailTrue) {
                    setSuccess(email);
                } else {
                    setError(email, 'Usuário não encontrado');
                }
            } catch (error) {
                alert("Erro: " + error);
                setError(email, 'Erro ao validar email');
            }
        }

        if ($('#SenhaFuncionario').val() === "") {
            setError(senha, 'Senha precisa ser escrita');
        } else{
            try {
                senhaTrue = await validaSenha();
                if (senhaTrue) {
                    setSuccess(senha);
                } else {
                    setError(senha, 'Senha incorreta');
                }
            } catch (error) {
                alert("Erro: " + error);
                setError(senha, 'Erro ao validar email');
            }
        }

    

        //se todas as auxiliares forem verdadeiras, eu permito que o form seja enviado (submitado)
        if ( emailTrue==true && senhaTrue == true) {

            $('#formLogin').submit();

        } else {
            //se nao, o return false faz ele ficar na guia, e exibe o erro
            return false;
        }
    });
});



