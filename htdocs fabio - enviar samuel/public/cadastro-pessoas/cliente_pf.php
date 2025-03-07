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
            <form class="forms" id="forms" method="POST" action="../../serverside/controllers/pessoas/registrar_cliente_pf.php" onsubmit="return validarFormulario()">
                <fieldset class="fieldset-basic-info">
                    <legend>Informações básicas</legend>
                    
                    <label for="nome">Nome:</label>
                    <input id="nome" name="nome" type="text" placeholder="Nome e sobrenome" required>
                    
                    <label for="email">E-mail:</label>
                    <input id="email" name="email" type="email" placeholder="email@dominio.com" required>
                    
                    <label for="telefone">Telefone:</label>
                    <input id="telefone" name="telefone" type="text" placeholder="(xx) xxxxx-xxxx" required oninput="mascaraTelefone(this)">
                    
                    <label for="nascimento">Nasc.:</label>
                    <input id="nascimento" name="nascimento" type="text" placeholder="dd/mm/yyyy" required oninput="mascaraData(this)">
                </fieldset>

                <fieldset>
                    <legend>Pessoa Física</legend>
                    <div class="radio">
                        <input type="radio" id="nacionalidade_brasileiro" name="nacionalidade" value="brasileiro" checked> Brasileiro
                        <input type="radio" id="nacionalidade_estrangeiro" name="nacionalidade" value="estrangeiro"> Estrangeiro
                    </div>
                    <label for="cpf_rg">CPF:</label>
                    <input id="cpf_rg" name="cpf_rg" type="text" oninput="mascaraCPF(this)" placeholder="Digite o CPF">
                    
                    <label for="passaporte">Passaporte:</label>
                    <input id="passaporte" name="passaporte" type="text" placeholder="Preencha se for Estrangeiro" disabled>
                    
                    <label for="origem">País de origem:</label>
                    <input id="origem" name="origem" type="text" placeholder="Preencha se for Estrangeiro" disabled>
                </fieldset>

                <fieldset>
                    <legend>Endereço</legend>
                    
                    <label for="pais">País:</label>
                    <input id="pais" name="pais" type="text" value="Brasil" required>
                    
                    <label for="cep">CEP:</label>
                    <input id="cep" name="cep" type="text" placeholder="Digite o CEP" oninput="mascaraCEP(this)" required onblur="buscarEndereco(this.value)">
                    
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
    <script src="../assets/js/cadastro-pessoas/cliente-pf.js"></script>
</body>
</html>
