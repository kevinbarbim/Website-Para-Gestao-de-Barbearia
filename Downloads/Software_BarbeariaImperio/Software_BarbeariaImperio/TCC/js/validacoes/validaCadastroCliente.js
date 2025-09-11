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


//validacao pronta, para ver se o email existe mesmo
const emailValidacaoPronta = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
};


//chama essa funcao quando o botao for clicado

$(document).ready(function() {
    $('#botaoLogar').click(async function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário
        
        //pega os elementos do campo
        const email = document.getElementById('emailCliente');
        const tel = document.getElementById('TelCliente');
        const nome = document.getElementById('NomeCliente');
        const sobrenome = document.getElementById('SobreCliente');
    
        //variaveis auxiliares para comprovar a validacao
        let emailTrue = false;
        let telTrue = false;
        let nomeTrue = false;
        let sobrenomeTrue = false;

        if ($('#NomeCliente').val() === "") {
            setError(nome, 'Nome deve ser inserido');
        } else if ($('#NomeCliente').val().length < 3) {
            setError(nome, 'Nome muito curto');
        } else if ($('#NomeCliente').val().length > 30) {
            setError(nome, 'Nome muito longo');
        } else {
            setSuccess(nome);
            nomeTrue = true;
        }
    
        // Validação do sobrenome
        if ($('#SobreCliente').val() === "") {
            setError(sobrenome, 'Sobrenome deve ser inserido');
        } else if ($('#SobreCliente').val().length < 3) {
            setError(sobrenome, 'Sobrenome muito curto');
        } else if ($('#SobreCliente').val().length > 30) {
            setError(sobrenome, 'Sobrenome muito longo');
        } else {
            setSuccess(sobrenome);
            sobrenomeTrue = true;
        }





       
        

        if ($('#emailCliente').val() === "") {
            setError(email, 'Email precisa ser escrito');
        } else if(!emailValidacaoPronta($('#emailCliente').val())){
            setError(email, 'Email inválido');
        }else{
            emailTrue = true;
            setSuccess(email);
        }

       


        if ($('#TelCliente').val() === "") {
            setError(tel, 'Telefone precisa ser escrito');
        } else if($('#TelCliente').val().length < 15) {
            setError(tel, 'Telefone inválido');
        }else{
            telTrue = true;
            setSuccess(tel);
        }


        //se todas as auxiliares forem verdadeiras, eu permito que o form seja enviado (submitado)
        if (telTrue==true && emailTrue==true && nomeTrue == true && sobrenomeTrue ==true) {

            $('#formCadastroCliente').submit();

        } else {
            //se nao, o return false faz ele ficar na guia, e exibe o erro
            return false;
        }
    });
});