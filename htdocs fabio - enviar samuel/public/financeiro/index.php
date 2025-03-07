<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/main.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php include('../../includes/main-sidebar.php'); ?>
    <?php include('../../includes/topbar.php'); ?>

    <main class="content">
        <div class="navbar" id="navbar"></div>

        <br>
        <section>
        <h1>Registrar Movimentação Financeira</h1>
        <br>
            <form action="processa_movimentacao.php" id="forms" method="POST">
                <label for="tipo_movimentacao">Tipo de Movimentação:</label>
                <select id="tipo_movimentacao" name="tipo_movimentacao" required>
                    <option value="">Selecione</option>
                    <option value="Entrada">Entrada</option>
                    <option value="Saida">Saída</option>
                </select>
                <br><br>

                <label for="descricao">Descrição:</label>
                <input type="text" id="descricao" name="descricao" maxlength="255" required>
                <br><br>

                <label for="valor">Valor (R$):</label>
                <input type="number" id="valor" name="valor" step="0.01" min="0" required>
                <br><br>

                <label for="forma_pagamento">Forma de Pagamento:</label>
                <input type="text" id="forma_pagamento" name="forma_pagamento" maxlength="50" required>
                <br><br>

                <label for="observacoes">Observações (opcional):</label>
                <textarea id="observacoes" name="observacoes" rows="4" cols="50"></textarea>
                <br><br>

                <button class="register-btn" type="submit">Registrar Movimentação</button>
            </form>
        </section>
        
    </main>
<script src="../public/assets/js/main.js"></script>
</body>
</html>