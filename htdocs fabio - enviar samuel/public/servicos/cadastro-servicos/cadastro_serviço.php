<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/servicos/cadastro-servicos/cadastro_servico.css">

</head>

<body>
    <?php include('../../../includes/main-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>
    
    <?php include('../../../serverside/config/dbConnection.php'); 
    $conn = dbConnection();
    ?>

    <div class="content">
        <h1>Registrar novo serviço</h1>
    
        <form id="form" action="../../../public/servicos/cadastro-servicos/insert_servicos.php" method="post" >
            <label for="tipo">Qual é o tipo de serviço? </label>
            <input type="text" id="tipo" name="tipo" placeholder="Tipo de serviço" required>

            <label for="preco">Preço deste serviço: </label>
            <input type="number" id="preco" name="preco" placeholder="Preço atual por esse serviço">

            <label for="precificacao">Tipo de precificação</label>
            <input type="text" id="precificacao" name="precificacao" placeholder="Tipo de precificação" required>
                
            

            
            
            <button type="button" onclick="exibirConfirmacao()">Cadastrar serviço</button>
            <button type="button" onclick="cancelar1()">Cancelar</button>
            
        </form>
        

        <div id="confirmacao">
            <h3>Confirmar cadastro:</h3>
            <p id="confirmacaoTipo"></p>
            <p id="confirmacaoPreco"></p>
            <p id="confirmacaoPrecificacao"></p>
            <button type="button" onclick="confirmarCadastro()">Confirmar</button>
            <button type="button" onclick="cancelar()">Cancelar</button>
        </div>
    </div>

    <script>
        function cancelar1(){
            window.location.href = 'servicos_home.php'
        }
        function adicionarPreco() {
            let select = document.getElementById('select');
            const optionSelected = select.options[select.selectedIndex].textContent;
            console.log(optionSelected);

            if (optionSelected == "Adicionar novo") {
                let priceType = document.getElementById("price");
                priceType.style.display = "block";
            }
        }

        function cancelar() {
            document.getElementById("price").style.display = "none";
            document.getElementById("form").reset();
            document.getElementById("confirmacao").style.display = "none"; 
        }

        function exibirConfirmacao() {
            
            const tipo = document.getElementById('tipo').value;
            const preco = parseFloat(document.getElementById('preco').value);
            const precificacao = document.getElementById('precificacao') ? document.getElementById('precificacao').value : '';

            
            document.getElementById('confirmacaoTipo').textContent = "Tipo de serviço: " + tipo;
            document.getElementById('confirmacaoPreco').textContent = "Preço: R$ " + preco;
            document.getElementById('confirmacaoPrecificacao').textContent = "Precificação: " + precificacao;

            
            document.getElementById("confirmacao").style.display = "block";
            document.getElementById("form").style.display = "none"; 
        }

        function confirmarCadastro() {
      
            document.getElementById("form").submit();
        }
    </script>
</body>
</html>