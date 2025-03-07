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
                    <legend>Correios</legend>
                    
                    <label for="nome">Nome do correio:</label>
                    <input id="correio" name="correio" type="text" placeholder="" required>
                    
                    <label for="Endereço da cobrança:">Endereço da cobrança:</label>
                    <input id="ende" name="ende" type="text" placeholder="" required>
                    
                    <label for="Nº do endereço da cobrança: ">Nº do endereço da cobrança:</label>
                    <input id="nende_c" name="nende_c" type="text" placeholder="" required>
                    
                    <label for="Cidade da cobrança:">Cidade da cobrança:</label>
                    <input id="cidade_c" name="cidade_c" type="text" placeholder="" required>

                    <label for="Bairro da cobrança:">Bairro da cobrança:</label>
                    <input id="bairro_c" name="bairro_c" type="text" placeholder="" required>
                    
                    <label for="UF da cobrança:">UF da cobrança:</label>
                    <input id="uf_c" name="uf_c" type="text" placeholder="" required>
                </fieldset>
              

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