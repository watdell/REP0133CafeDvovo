<?php
  include '../../serverside/queries/db_queries.php';
  include '../../serverside/config/dbConnection.php';
  include '../../includes/main-sidebar.php';

  $conn = dbConnection();
    
?>

<!DOCTYPE html>
<html lang="pt-br">
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

        
        <div id="crudModal" class="modal">

            <div class="modal-content">
                <span onclick="fecharModal()" style="cursor:pointer; float:right;">&times;</span>
                <h2>Adicionar Insumo</h2>
                <input type="search" id="search" onchange="search('searchbody')"></input>
                <form method="POST" action="conexao.php">
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

                    <button type="submit" name="action" value="update">Adicionar</button>
                </form>
            </div>
        </div>
        
        
        <table border="1" cellspacing='0' cellpadding='8'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Unidade de Medida</th>
                    <th>Custo Unitário (R$)</th>
                    <th>Estoque Atual</th>
                    <th>Data de Validade</th>
                    <th>Data de Cadastro</th>
                    <th>Excluir</th>
                    <th>Editar</th>
                </tr>
            </thead>
        <tbody id='searchbody'></tbody></table> 

        

       
    </main>
        <script src="insumos.js"></script>
        <script>
    function abrirmodal() {
        document.getElementById("crudModal").style.display = "block";
    }

    function fecharModal() {
        document.getElementById("crudModal").style.display = "none";
    }

 
    



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
    search('searchbody');
</script>

  