<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual de Uso da Página de Serviços</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F4F4F4;
            margin: 0;
            padding: 0;
        }
        .content {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #FFF;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #E50000;
            text-align: center;
        }
        h2 {
            color: #101820;
        }
        ul {
            font-size: 16px;
            list-style-type: none;
            padding-left: 20px;
        }
        ul li {
            margin-bottom: 10px;
        }
        ol {
            font-size: 16px;
            padding-left: 20px;
        }
        .section-title {
            font-size: 18px;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include('../../includes/main-sidebar.php'); ?> <!-- Temporário(?) -->
    <?php include('../../includes/topbar.php'); ?> 

    <div class="content">
        <h1>Manual de Uso da Página de Serviços</h1>
        
        <div class="section">
            <p class="section-title">1. Página Inicial de Serviços</p>
            <ul>
                <li>Ao acessar a página de serviços, você visualizará uma lista com todos os serviços previamente cadastrados.</li>
                <li>Cada serviço será exibido com as seguintes informações:
                    <ul>
                        <li><strong>ID:</strong> Identificação única do serviço.</li>
                        <li><strong>Tipo de Serviço:</strong> Descrição do serviço.</li>
                        <li><strong>Preço:</strong> Valor associado ao serviço.</li>
                        <li><strong>Precificação:</strong> Detalhes sobre como o preço foi calculado ou outras informações de precificação.</li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="section">
            <p class="section-title">2. Ações Disponíveis para os Serviços</p>
            <ul>
                <li>Para cada serviço listado, você encontrará dois botões visíveis:</li>
                <ul>
                    <li><strong>Deletar:</strong> Ao clicar neste botão, o serviço será totalmente removido do sistema, incluindo todas as informações associadas ao cadastro.</li>
                    <li><strong>Editar:</strong> Ao clicar neste botão, você poderá editar as informações do serviço. Isso permitirá atualizar o tipo de serviço, preço, precificação ou outros dados relevantes.</li>
                </ul>
            </ul>
        </div>

        <div class="section">
            <p class="section-title">3. Cadastrar Novo Serviço</p>
            <ul>
                <li>Abaixo da lista de serviços cadastrados, haverá dois botões:</li>
                <ul>
                    <li><strong>Cadastrar Novo Serviço:</strong> Ao clicar nesse botão, você será redirecionado para um formulário onde poderá cadastrar um novo serviço, fornecendo todos os dados necessários, como tipo de serviço, preço e precificação.</li>
                    <li><strong>Voltar:</strong> Ao clicar nesse botão, você retornará à página anterior, onde poderá realizar outras ações conforme necessário.</li>
                </ul>
            </ul>
        </div>

        <div class="section">
            <p class="section-title">Instruções Detalhadas para Utilização</p>
            <ol>
                <li><strong>Deletar um Serviço:</strong>
                    <ol>
                        <li>Encontre o serviço que deseja excluir.</li>
                        <li>Clique no botão <strong>Deletar</strong> ao lado do serviço.</li>
                        <li>Confirme a ação, caso uma confirmação seja solicitada.</li>
                        <li>O serviço será removido permanentemente.</li>
                    </ol>
                </li>
                <li><strong>Editar um Serviço:</strong>
                    <ol>
                        <li>Encontre o serviço que deseja editar.</li>
                        <li>Clique no botão <strong>Editar</strong> ao lado do serviço.</li>
                        <li>Atualize as informações desejadas (tipo de serviço, preço, etc.).</li>
                        <li>Salve as alterações feitas.</li>
                        <li>O serviço será atualizado com os novos dados fornecidos.</li>
                    </ol>
                </li>
                <li><strong>Cadastrar Novo Serviço:</strong>
                    <ol>
                        <li>Clique no botão <strong>Cadastrar Novo Serviço</strong> abaixo da lista de serviços.</li>
                        <li>Preencha todos os campos do formulário (tipo de serviço, preço, precificação).</li>
                        <li>Clique em <strong>Cadastrar</strong> para adicionar o novo serviço ao sistema.</li>
                    </ol>
                </li>
                <li><strong>Voltar à Página Anterior:</strong>
                    <ol>
                        <li>Clique no botão <strong>Voltar</strong> para retornar à página anterior sem fazer alterações.</li>
                    </ol>
                </li>
            </ol>
        </div>
    </div>
</body>
</html>
