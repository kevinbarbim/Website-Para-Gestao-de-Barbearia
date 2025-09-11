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
async function validaNomeProduto() {
    return new Promise((resolve, reject) => {

        const emailBanco = { e: $('#NomeProduto').val().trim(),
                             s: $('#idProduto').val().trim()};
        const dados = JSON.stringify(emailBanco);

//manda pro pesquisa

        $.ajax({
            url: '../../Telas/phpComplementar/pesquisaNomeProduto.php',
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
    $('#botaoCadastro').click(async function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário
        
        //pega os elementos do campo
  
        const nome = document.getElementById('NomeProduto');
        const estoque = document.getElementById('EstoqueInicial');
        const valor = document.getElementById('ValorUnitario');
        const desc = document.getElementById('DescricaoProduto');
    
     
    
        //variaveis auxiliares para comprovar a validacao
     
        let descTrue = false;
        let nomeTrue = false;
        let estoqueTrue = false;
        let valorTrue = false;
     
        //comeco real das validacoes, se tiver uma errada form nao avança

        if ($('#DescricaoProduto').val() === "") {
            setError(desc, 'Descrição deve ser inserida');
        } else if ($('#DescricaoProduto').val().length < 15) {
            setError(desc, 'Descrição muito curta');
        } else if ($('#DescricaoProduto').val().length > 299) {
            setError(desc, 'Descrição muito longa');
        } else {
            setSuccess(desc);
            descTrue = true;
        }
   


        if ($('#NomeProduto').val() === "") {
            setError(nome, 'Digite o nome do produto');
        } else {
            try {
                nomeTrue = await validaNomeProduto();
                if (nomeTrue) {
                    setSuccess(nome);
                } else {
                    setError(nome, 'Produto ja cadastrado');
                }
            } catch (error) {
                alert("Erro: " + error);
                setError(nome, 'Erro ao validar produto');
            }
        }

        if ($('#EstoqueInicial').val() === "") {
            setError(estoque, 'Quantidade em estoque?');
        } else if($('#EstoqueInicial').val() > 9999){
            setError(estoque, 'Digite uma qtd válida');
        }else{
            setSuccess(estoque);
            estoqueTrue = true;
        }
    
        if ($('#ValorUnitario').val() === "") {
            setError(valor, 'Valor necessario');
        } else if ($('#ValorUnitario').val().length < 3) {
            setError(valor, 'Valor Inválido');
        } 
        else {
            setSuccess(valor);
             valorTrue = true;
        }
    





        //se todas as auxiliares forem verdadeiras, eu permito que o form seja enviado (submitado)
        if (nomeTrue==true && estoqueTrue == true && valorTrue == true &&  descTrue == true) {

            $('#formCadastroProduto').submit();

        } else {
            //se nao, o return false faz ele ficar na guia, e exibe o erro
            return false;
        }
    });
});


