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

const validateCheckboxes = () => {
    const checkboxes = document.querySelectorAll('input[name="servicos[]"]');
    let checked = false;

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            checked = true;
        }
    });

    return checked;
};


async function validaHorario() {
  return new Promise((resolve, reject) => {

      const emailBanco = { e: $('#Funcionario').val().trim(),
                           s:$('#textoData').val().trim(),
                           g:$('#Horario').val().trim(),
                           i:$('#id').val().trim() };

      const dados = JSON.stringify(emailBanco);

//vai no pesquisa email, executa, se tiver um chama como falso

      $.ajax({
          url: '../../Telas/phpComplementar/pesquisaHorarioLivre.php',
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

async function validaCliente() {
  return new Promise((resolve, reject) => {

      const emailBanco = { e: $('#Cliente').val().trim(),
                           s:$('#textoData').val().trim(),
                           g:$('#Horario').val().trim(),
                           i:$('#id').val().trim() };

      const dados = JSON.stringify(emailBanco);

//vai no pesquisa email, executa, se tiver um chama como falso

      $.ajax({
          url: '../../Telas/phpComplementar/pesquisaClienteLivre.php',
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
     
      const hora = document.getElementById('Horario');
      const valor = document.getElementById('valor');
      const data = document.getElementById('textoData');
      const feito = document.getElementById('Feito');
      const func = document.getElementById('Funcionario');
      const cli = document.getElementById('Cliente');
     
   
  
      //variaveis auxiliares para comprovar a validacao
   
      let horaTrue = false;
      let valorTrue = false;
      let dataTrue = false;
      let feitoTrue = false;
      let clienteTrue = false;
      let livre = false;
      let caixaTrue = false;

      if ($('#Horario').val() === "") {
          setError(hora, 'Horario deve ser inserido');
      } else if ($('#Horario').val().length != 5) {
          setError(hora, 'Horario invalido');
      }else {
          setSuccess(hora);
          horaTrue = true;
      }
 
     

      
      if ($('#valor').val() === "") {
        setError(valor, 'Valor deve ser inserido');
    } else {
        setSuccess(valor);
        valorTrue = true;
    }


    if ($('#textoData').val() === "") {
      setError(data, 'Data deve ser inserida');
  } else {
      setSuccess(data);
       dataTrue = true;
  }

  
  if ($('#Feito').val() === "") {
    setError(feito, 'Insira o que sera feito'); //chama função / classe, fornece o elemento do erro e a mensagem personalizada
} else if ($('#Feito').val().length < 10) {
    setError(feito, 'Insira corretamente');
} else if($('#Feito').val().length > 299){
  setError(feito, 'Insira corretamente');
}else{
    setSuccess(feito);
     feitoTrue = true;
}




      if ($('#Cliente').val() === "") {
          setError(email, 'Cliente precisa ser selecionado');
      }else{
          try {
              clienteTrue = await validaCliente();
              if (clienteTrue) {
                  setSuccess(cli);
              } else {
                  setError(cli, 'Cliente ja tem um servico agendado neste horario');
              }
          } catch (error) {
              alert("Erro: " + error);
              setError(cli, 'Erro ao validar email');
          }
      }



    


if ($('#Funcionario').val().trim() === "") {
  setError(func, 'Selecione um funcionario');
} else {
  try {
    livre = await validaHorario();
      if (livre) {
          setSuccess(func);
      } else {
          setError(func, 'Este barbeiro ja tem um serviço nesta data / horario');
      }
  } catch (error) {
      alert("Erro: " + error);
      setError(func, 'Erro ao validar Horario');
  }
}
  
     







      //se todas as auxiliares forem verdadeiras, eu permito que o form seja enviado (submitado)
      if (dataTrue==true  && feitoTrue == true && valorTrue == true && horaTrue == true && livre == true && clienteTrue == true) {

        checkboxesValid = validateCheckboxes();
        if (!checkboxesValid) {
            alert('Por favor, selecione pelo menos um serviço.');
        }else{
            $('#formAgendaHorario').submit();
        }

      }else{
        return false;
      }
  });
});

