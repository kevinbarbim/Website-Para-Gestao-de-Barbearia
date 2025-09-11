//classes que vão dar cor aos labels

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

//validacao pronta de email
const emailValidacaoPronta = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
};




// Função assíncrona que valida o telefone, tem que ser assim para interpretar js e ajax junto
async function validaTel() {
    return new Promise((resolve, reject) => {

        const telefoneBanco = { e: $('#TelFuncionario').val().trim(),
                                 s:$('#id').val().trim() };
        const dados = JSON.stringify(telefoneBanco);

 //vai no pesquisa tel, executa, se tiver um chama como falso

        $.ajax({
            url: '../../Telas/phpComplementar/pesquisaTelFuncionario.php',
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

async function validaEmail() {
    return new Promise((resolve, reject) => {

        const emailBanco = { e: $('#LoginFuncionario').val().trim(),
                             s:$('#id').val().trim() };
        const dados = JSON.stringify(emailBanco);

 //vai no pesquisa email, executa, se tiver um chama como falso

        $.ajax({
            url: '../../Telas/phpComplementar/pesquisaEmailFuncionario.php',
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
        const tel = document.getElementById('TelFuncionario');
        const nome = document.getElementById('NomeFuncionario');
        const rg = document.getElementById('RGFuncionario');
        const cpf = document.getElementById('CPFFuncionario');
        const senha = document.getElementById('SenhaFuncionario');
     
    
        //variaveis auxiliares para comprovar a validacao
        let emailTrue = false;
        let telTrue = false;
        let nomeTrue = false;
        let rgTrue = false;
        let cpfTrue = false;
        let senhaTrue = false;

        if ($('#NomeFuncionario').val() === "") {
            setError(nome, 'Nome deve ser inserido');
        } else if ($('#NomeFuncionario').val().length < 3) {
            setError(nome, 'Nome muito curto');
        } else if ($('#NomeFuncionario').val().length > 30) {
            setError(nome, 'Nome muito longo');
        } else {
            setSuccess(nome);
            nomeTrue = true;
        }
   





       
        

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
                    setError(email, 'Email ja cadastrado');
                }
            } catch (error) {
                alert("Erro: " + error);
                setError(email, 'Erro ao validar email');
            }
        }











        if ($('#TelFuncionario').val() === "") {
            setError(tel, 'Telefone precisa ser escrito');
        } else {
            try {
                telTrue = await validaTel();
                if (telTrue) {
                    setSuccess(tel);
                } else {
                    setError(tel, 'Telefone já cadastrado');
                }
            } catch (error) {
                alert("Erro: " + error);
                setError(tel, 'Erro ao validar telefone');
            }
        }


        if ($('#RGFuncionario').val() === "") {
            setError(rg, 'RG deve ser inserido');
        } else if ($('#RGFuncionario').val().length != 12) {
            setError(rg, 'RG invalido');
        }
        else {
            setSuccess(rg);
            rgTrue = true;
        }
    
        if ($('#CPFFuncionario').val() === "") {
            setError(cpf, 'CPF deve ser inserido');
        } else if ($('#CPFFuncionario').val().length != 14) {
            setError(cpf, 'CPF invalido');
        }
        else {
            setSuccess(cpf);
             cpfTrue = true;
        }
    


        if ($('#SenhaFuncionario').val() === "") {
            setError(senha, 'Senha deve ser inserida'); //chama função / classe, fornece o elemento do erro e a mensagem personalizada
        } else if ($('#SenhaFuncionario').val().length < 3) {
            setError(senha, 'Senha muito curta');
        } else {
            setSuccess(senha);
             senhaTrue = true;
        }







        //se todas as auxiliares forem verdadeiras, eu permito que o form seja enviado (submitado)
        if (telTrue==true && emailTrue==true && nomeTrue == true && rgTrue == true && cpfTrue == true && senhaTrue == true) {

            $('#formCadastroFuncionario').submit();

        } else {
            //se nao, o return false faz ele ficar na guia, e exibe o erro
            return false;
        }
    });
});

