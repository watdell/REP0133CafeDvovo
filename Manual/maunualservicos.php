<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Serviços</title>
    <link rel="stylesheet" href="../assets/css/main.css">

<style>
    header h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .section {
        margin-bottom: 30px;
    }

    .section h2 {
        margin-bottom: 10px;
        color: #444;
    }

    .section p, .section ul {
        margin-left: 20px;
    }

    .section ul {
        list-style-type: disc;
    }

    .section ul ul {
        list-style-type: circle;
        margin-left: 20px;
    }

</style>
</head>

<body>
    <?php include('../../includes/main-sidebar.php'); ?>
    <?php include('../../includes/topbar.php'); ?>

    <div class="content">
        <header>
            <h1>Manual de Cadastro de Serviços</h1>
        </header>
        <main>
            <div class="section">
                <h2>1. Introdução</h2>
                <p>Este manual orienta sobre o processo de Cadastro de Serviços no sistema. Abaixo estão os passos para cadastrar um serviço corretamente.</p>
            </div>
            <div class="section">
                <h2>2. Acessando o Menu de Cadastro de Serviços</h2>
                <ul>
                    <li><strong>Acessar o Sistema:</strong> Entre no sistema onde o cadastro de serviços está disponível.</li>
                    <li><strong>Selecionar o Menu de Serviços:</strong> Clique na opção "Cadastro de Serviços" no menu principal.</li>
                </ul>
            </div>
            <div class="section">
                <h2>3. Opções na Tela de Cadastro</h2>
                <ul>
                    <li><strong>Tipo de Serviço:</strong> Selecione o tipo de serviço desejado a partir das opções disponíveis.</li>
                    <li><strong>Preço de Serviço:</strong> Insira o valor correspondente ao serviço.</li>
                    <li><strong>Ações:</strong>
                        <ul>
                            <li><strong>Cadastrar Serviço:</strong> Para registrar o serviço com as informações preenchidas.</li>
                            <li><strong>Cancelar:</strong> Para descartar as informações inseridas e retornar à tela anterior.</li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="section">
                <h2>4. Fluxo do Cadastro</h2>
                <ul>
                    <li><strong>Escolher o Tipo de Serviço:</strong> Selecione o tipo de serviço.</li>
                    <li><strong>Inserir Preço:</strong> Preencha o campo de preço.</li>
                    <li><strong>Escolher Ação:</strong>
                        <ul>
                            <li><strong>Cadastrar Serviço:</strong> Clique para salvar as informações.</li>
                            <li><strong>Cancelar:</strong> Clique para abandonar o cadastro.</li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="section">
                <h2>5. Considerações Finais</h2>
                <ul>
                    <li><strong>Precisão:</strong> Preencha corretamente o tipo de serviço e o preço, pois essas informações são essenciais para o cadastro.</li>
                    <li><strong>Alterações:</strong> Para editar um serviço cadastrado, acesse a área de Edição de Serviços.</li>
                </ul>
            </div>
            <div class="section">
                <h2>6. Suporte</h2>
                <p>Se necessário, entre em contato com o suporte técnico para assistência.</p>
            </div>
        </main>
    </div>
</body>
</html>
