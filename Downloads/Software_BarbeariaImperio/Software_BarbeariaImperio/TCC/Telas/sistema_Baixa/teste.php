<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário com Checkboxes e Text Inputs</title>
    <!-- Incluindo jQuery e jQuery Mask Plugin -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
</head>
<body>
    <h1>Formulário com Checkboxes e Text Inputs</h1>
    <form action="processaFormulario.php" method="post">
        <?php
        function chamaProduto(){
            // Realizando a conexão com o banco de dados
            $con = mysqli_connect("localhost", "root", "", "bd_TCC");

            // Verifica se a conexão foi bem-sucedida
            if (!$con) {
                die("Erro na conexão: " . mysqli_connect_error());
            }

            // Criando o comando SQL para consulta dos registros
            $comandoSql = "SELECT id_produto, nome_produto FROM tb_produto order by id_produto";

            // Executando o comando SQL
            $resultado = mysqli_query($con, $comandoSql);
            
            $numero = mysqli_num_rows($resultado);

            // Verifica se a consulta foi bem-sucedida
            if (!$resultado) {
                die("Erro na consulta: " . mysqli_error($con));
            }

            // Pegando os dados da consulta e exibindo
            while ($dados = mysqli_fetch_assoc($resultado)) {
                $id = $dados["id_produto"];
                $nome = $dados["nome_produto"];
                
                // Gerando IDs e names para campos de texto e checkboxes
                echo "<div>";
                echo "<label for='checkbox$id'>$nome</label>";
                echo "<input type='checkbox' id='checkbox$id' name='checkbox$id' value='$id'>";
                echo "<input type='text' id='text$id' name='text$id' disabled>";
                echo "</div>";
            }

            echo "<input type='text' name='numero' id='numero' value='$numero'>";

            // Fecha a conexão com o banco de dados
            mysqli_close($con);
        }

        // Utilizando uma função para o formulário ser mais fácil de entender
        chamaProduto();
        ?>
        <button type="submit">Enviar</button>
    </form>
    <script>
    $(document).ready(function() {
        // Função para atualizar o campo de texto com base no estado da checkbox
        function ativaTexto() {
            $('input[type="checkbox"]').each(function() {
                const checkbox = $(this);
                const id = checkbox.attr('id').replace('checkbox', '');
                const textInput = $('#text' + id);
                
                // Atualiza a propriedade 'required' e o estado do campo de texto
                if (checkbox.is(':checked')) {
                    textInput.prop('disabled', false);
                    textInput.prop('required', true);
                } else {
                    textInput.prop('disabled', true);
                    textInput.prop('required', false);
                }
            });
        }

        // Adiciona um listener para todos os checkboxes
        $('input[type="checkbox"]').on('change', ativaTexto);

        // Inicializa o estado dos campos de texto
        ativaTexto();

        // Função para aplicar máscara a todos os campos de texto
        function mascaraTodosTXT() {
            $('input[type="text"]').each(function() {
                const textInput = $(this);
                // Defina a máscara desejada aqui, você pode alterar conforme necessário
                textInput.mask('0000'); // Exemplo de máscara de 4 dígitos
            });
        }

        // Aplica as máscaras após a página estar pronta
        mascaraTodosTXT();
    });
    </script>
</body>
</html>
