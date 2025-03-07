<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/assets/css/cadastrar-produtos/forms-style.css">
    
    <title>Pós-Vendas</title>
    
</head>
<body>
<?php include('../../../includes/main-sidebar.php'); ?>
<?php include('../../../includes/topbar.php'); ?>
    <div class="content">
        
        <form id="posVendasForm" class = "form-group">
        <h2>Formulário Pós-Vendas</h2>
            <fieldset class = "fieldset">
            <label for="codigoVenda">Código da Venda</label>
            <input type="text" id="codigoVenda" name="codigoVenda" placeholder="Digite o código da venda" required>

            <label for="cliente">Cliente</label>
            <input type="text" id="cliente" name="cliente" placeholder="id do cliente" required>

            <label for="tipoFeedback">Tipo de Feedback</label>
            <select id="tipoFeedback" name="tipoFeedback" required>
                <option value="" disabled selected>Selecione...</option>
                <option value="devolucao">Devolução</option>
                <option value="reclamacao">Reclamação</option>
                <option value="sugestao">Sugestão</option>
            </select>

            <label for="notaAtendimento">Nota do Atendimento</label>
            <input type="number" id="notaAtendimento" name="notaAtendimento" placeholder="De 1 a 10" min="1" max="10" required>

            <label for="notaProduto">Nota do Produto</label>
            <input type="number" id="notaProduto" name="notaProduto" placeholder="De 1 a 10" min="1" max="10" required>

            <button type="submit" class="register-btn">Enviar</button>
            <br>
            
            <button class="register-btn" onclick="location.href='/public/comercial/venda/venda.php'">Voltar para venda</button>

            </fieldset>
        </form>
    </div>
</body>
</html>
