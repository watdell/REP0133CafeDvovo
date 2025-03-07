<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/cadastro-pessoas/cadastro-pessoas.css">    

    <title>Transportadoras</title>
</head>
<body>
    <?php include('../../../includes/main-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>
    <main class="content">
        <div class="navbar" id="navbar"></div>
        <br>
        <section>
            <form class="forms" id="forms" method="POST" action="../../serverside/controllers/pessoas/registrar_cliente_pj.php" onsubmit="return validarFormulario()">
                <fieldset class="fieldset-basic-info">
                <legend>Empresas</legend>
                    
                    <label for="nome">Nome da empresa:</label>
                    <input id="empresa" name="empresa" type="text" placeholder="" required>
                 
                    <label for="CEP da empresa: ">CEP da empresa:</label>
                    <input id="cep_e" name="cep_e" type="text" placeholder="" required>
                    
                    <label for="Endereço da empresa: ">Endereço da empresa: </label>
                    <input id="ende_e" name="ende_e" type="text" placeholder="" required>

                    <label for="Número:">Número e Complemento:</label>
                    <input id="num" name="num" type="text" placeholder="" required>
                    
                    <label for="Cidade da empresa:	">Cidade da empresa:</label>
                    <input id="cidade_e" name="cidade_e" type="text" placeholder="" required>

                    <label for="Bairro da empresa:	">Bairro da empresa:</label>
                    <input id="bairro_e" name="bairro_e" type="text" placeholder="" required>
                    
                    <label for="UF da empresa:	">UF da empresa:</label>
                    <input id="uf_e" name="uf_e" type="text" placeholder="" required>

                    <label for="CNPJ:	">CNPJ:</label>
                    <input id="cnpj" name="cnpj" type="text" placeholder="" required>

                    <button type="submit" class="register-btn">Finalizar Cadastro</button>

                    <div class="menu">
                    <ul>
                
                    <li><a href="http://172.16.16.58/public/expedicao/index.php">Voltar</a></li>
                    
                    </ul>
                 </div>
                </fieldset>
            </form>
        </section>
    </main>
 
</body>