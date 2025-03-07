<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/cadastro-pessoas/cadastro-pessoas.css">   
     
    <title>Sistema - Café de Vovô</title>
</head>
<body>
    <?php include('../../includes/main-sidebar.php'); ?>
    <?php include('../../includes/topbar.php'); ?>
    <main class="content">
        <div class="navbar" id="navbar"></div>
        <br>
        <section>
            <form class="forms" id="forms" method="POST" action="../../serverside/controllers/pessoas/registrar_fornecedor.php" onsubmit="return validarFormulario()">
                <fieldset class="fieldset-basic-info">
                    <legend>Informações básicas</legend>
                    
                    <label for="nome">Nome:</label>
                    <input id="nome" name="nome" type="text" placeholder="Nome e sobrenome" required>
                    
                    <label for="email">E-mail:</label>
                    <input id="email" name="email" type="email" placeholder="email@dominio.com" required>
                    
                    <label for="telefone">Telefone:</label>
                    <input id="telefone" name="telefone" type="text" placeholder="(xx) xxxxx-xxxx" required>
                    
                    <label for="nascimento">Nasc.:</label>
                    <input id="nascimento" name="nascimento" type="text" placeholder="dd/mm/yyyy" required>
                </fieldset>

                <fieldset>
                    <legend>Empresa</legend>
                    
                    <label for="nome_empresa">Nome da Empresa:</label>
                    <input id="nome_empresa" name="nome_empresa" type="text" placeholder="Digite o nome da empresa" required>
                    
                    <label for="cnpj_empresa">CNPJ - Empresa:</label>
                    <input id="cnpj_empresa" name="cnpj_empresa" type="text" placeholder="Digite o CNPJ da Empresa" required>
                </fieldset>

                <fieldset>
                    <legend>Endereço</legend>
                    
                    <label for="pais">País:</label>
                    <input id="pais" name="pais" type="text" value="Brasil" required>
                    
                    <label for="cep">CEP:</label>
                    <input id="cep" name="cep" type="text" placeholder="Digite o CEP" onblur="preencherEndereco(this)" required>
                    
                    <label for="estado">Estado:</label>
                    <input id="estado" name="estado" type="text" required>
                    
                    <label for="cidade">Cidade:</label>
                    <input id="cidade" name="cidade" type="text" required>
                    
                    <label for="bairro">Bairro:</label>
                    <input id="bairro" name="bairro" type="text" required>
                    
                    <label for="rua">Rua:</label>
                    <input id="rua" name="rua" type="text" required>
                    
                    <label for="numero">Número:</label>
                    <input id="numero" name="numero" type="text" required>
                    
                    <label for="complemento">Complemento:</label>
                    <input id="complemento" name="complemento" type="text">
                    
                    <button type="submit" class="register-btn">Finalizar Cadastro</button>
                </fieldset>
            </form>
        </section>
    </main>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/cadastro-pessoas/fornecedor.js"></script>
</body>
</html>
