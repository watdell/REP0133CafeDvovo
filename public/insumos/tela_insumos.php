<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Essa parte carrega e garante que sempre vai carregar a versão mais resente em cache -->
    <link rel="stylesheet" href="../assets/css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../assets/css/insumos/style.css?v=<?php echo time(); ?>">
    <title>Insumos</title>

    <!-- Includes -->
    <?php
        include '../../includes/main-sidebar.php';
    ?>

</head>
<body>
    <header class="topbar">Insumos</header>

    <main class="content" style="flex-direction:column;">

    <div> <!-- essa div separa o modal de cadastrar input e a imagem -->
        <!-- Cadastrar um insumo -->
        <div class='table register-input' style="flex-direction:column;max-width:70vw;">
            <div class="modal-content">
                <h2>Adicionar Insumo</h2>
                <form method="POST" action="conexao.php">
                    <div>
                        <label>Nome:</label>
                        <input type="text" name="nome" required><br><br>

                        <label>Unidade de Medida:</label>
                        <input type="text" name="unidade_medida" required><br><br>

                        <label>Custo Unitário (R$):</label>
                        <input type="number" step="0.01" name="custo_unitario" required><br><br>

                        <label>Estoque Atual:</label>
                        <input type="number" name="estoque_atual" required><br><br>

                        <label>Data de Validade:</label>
                        <input type="date" name="data_validade" required><br><br>

                        <button id="submit" type="submit" name="action" value="update">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Visualizador de insumos -->
        <div class='table view-inputs' style="flex-direction:column;">

            <!-- TABLE HEADER -->
            <div class="table-header">
                <h2>Insumos</h2>
                <input id='search' type='search' autocomplete="off" style='width:50%' placeholder='pesquisar por...' oninput='executarPesquisa("innertable")'></input>
            </div>

            <!-- TABLE ITSELF -->
            <div style="display:flex;flex-direction:row;">
                <div id='innertable' class="innertable" style="width:100%"></div>
            </div>

        </div>
    </main>

<script src="../assets/js/main.js?v=<?php echo time(); ?>"></script>
<script src="../assets/js/insumos/insumos.js?v=<?php echo time(); ?>"></script>
<script>
    function confirmarExclusao(id) {
        if (confirm("Tem certeza que deseja excluir este insumo?")) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'conexcao_d.php'; // Defina a URL de destino para o mesmo arquivo ou outro.

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'insumo_id';
            input.value = id;
            form.appendChild(input);

            var actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = 'delete';
            form.appendChild(actionInput);

            document.body.appendChild(form);
            form.submit();
        }
    }

    search('innertable');

    function executarPesquisa(inta) {
        search(inta);
    }

</script>
</body>
</html>
  