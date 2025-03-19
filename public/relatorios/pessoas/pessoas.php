<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/relatorios/relatorio-pessoas/relatorio-pessoas.css">
    <title>Sistema - Café de Vovô</title>
</head>
<body>
<?php include('../../../includes/main-sidebar.php'); ?>
<?php include('../../../includes/topbar.php'); ?>
    <main class="content">
        <div class="navbar" id="navbar"></div>
        <br>
        <section class="reports">
            <!-- Funcionários -->
            <div class="button-add-pessoa">
                    <div>
                        <h2>Funcionário</h2>
                    </div>
                    <div>
                        <form action="../../cadastro-pessoas/index.php">
                            <button class="button-submit" type="submit">Adicionar Pessoa</button>
                        </form>
                    </div>
                </div>
            <div class="report-category">
                
                
                <div class="card-grid">
                    <?php 

                        include ('../../../serverside/config/dbConnection.php');
                        include ('../../../serverside/queries/db_queries.php');

                        $conn = dbConnection();
                        
                        $query = getQuery('select_all_funcionarios');

                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="card">';
                                echo '<div class="card-header">';
                                echo '<h3>' . htmlspecialchars($row['nome']) . '</h3>';
                                echo '<div class="actions">';
                                echo '<a href="../../cadastro-pessoas/editar-cadastro/funcionario.php?id=' . $row['pessoa_id'] . '"><i class="icon-update">🖉</i></a>';
                                echo '<a href="../../../serverside/controllers/pessoas/remover_pessoa.php?id=' . $row['pessoa_id'] . '"><i class="icon-delete">🗑️</i></a>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="card-body">';
                                echo '<p><strong>E-mail:</strong> ' . htmlspecialchars($row['email']) . '</p>';
                                echo '<p><strong>Telefone:</strong> ' . htmlspecialchars($row['telefone']) . '</p>';
                                echo '<p><strong>Cargo:</strong> ' . htmlspecialchars($row['cargo']) . '</p>';
                                echo '<p><strong>Salário:</strong> R$' . htmlspecialchars($row['salario']) . '</p>';
                                echo '<p><strong>Data Cadastro:</strong> ' . htmlspecialchars($row['data_cadastro']) . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>Nenhum funcionário encontrado.</p>';
                        }
                    ?>
                </div>
            </div>

            <!-- Pessoa Física -->
            <div class="report-category">
                <h2>Pessoas Físicas</h2>
                <div class="card-grid">
                    <?php 

                        $query = getQuery('select_all_clientes_pf');

                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="card">';
                                echo '<div class="card-header">';
                                echo '<h3>' . htmlspecialchars($row['nome']) . '</h3>';
                                echo '<div class="actions">';
                                echo '<a href="../../cadastro-pessoas/editar-cadastro/pessoa-fisica.php?id=' . $row['pessoa_id'] . '"><i class="icon-update">🖉</i></a>';
                                echo '<a href="../../../serverside/controllers/pessoas/remover_pessoa.php?id=' . $row['pessoa_id'] . '"><i class="icon-delete">🗑️</i></a>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="card-body">';
                                echo '<p><strong>CPF/RG:</strong> ' . htmlspecialchars($row['cpf_rg']) . '</p>';
                                echo '<p><strong>E-mail:</strong> ' . htmlspecialchars($row['email']) . '</p>';
                                echo '<p><strong>Telefone:</strong> ' . htmlspecialchars($row['telefone']) . '</p>';
                                echo '<p><strong>Data Cadastro:</strong> ' . htmlspecialchars($row['data_cadastro']) . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>Nenhuma pessoa física encontrada.</p>';
                        }
                    ?>
                </div>
            </div>

            <!-- Pessoa Jurídica -->
            <div class="report-category">
                <h2>Pessoas Jurídicas</h2>
                <div class="card-grid">
                    <?php 

                        $query = getQuery('select_all_clientes_pj');

                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="card">';
                                echo '<div class="card-header">';
                                echo '<h3>' . htmlspecialchars($row['nome']) . '</h3>';
                                echo '<div class="actions">';
                                echo '<a href="../../cadastro-pessoas/editar-cadastro/pessoa-juridica.php?id=' . $row['pessoa_id'] . '"><i class="icon-update">🖉</i></a>';
                                echo '<a href="../../../serverside/controllers/pessoas/remover_pessoa.php?id=' . $row['pessoa_id'] . '"><i class="icon-delete">🗑️</i></a>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="card-body">';
                                echo '<p><strong>CNPJ:</strong> ' . htmlspecialchars($row['cnpj']) . '</p>';
                                echo '<p><strong>E-mail:</strong> ' . htmlspecialchars($row['email']) . '</p>';
                                echo '<p><strong>Telefone:</strong> ' . htmlspecialchars($row['telefone']) . '</p>';
                                echo '<p><strong>Data Cadastro:</strong> ' . htmlspecialchars($row['data_cadastro']) . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>Nenhuma pessoa jurídica encontrada.</p>';
                        }
                    ?>
                </div>
            </div>

            <!-- Fornecedores -->
            <div class="report-category">
                <h2>Fornecedores</h2>
                <div class="card-grid">
                    <?php 

                        $query = getQuery('select_all_fornecedores');

                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="card">';
                                echo '<div class="card-header">';
                                echo '<h3>' . htmlspecialchars($row['nome']) . '</h3>';
                                echo '<div class="actions">';
                                echo '<a href="../../cadastro-pessoas/editar-cadastro/fornecedor.php?id=' . $row['pessoa_id'] . '"><i class="icon-update">🖉</i></a>';
                                echo '<a href="../../../serverside/controllers/pessoas/remover_pessoa.php?id=' . $row['pessoa_id'] . '"><i class="icon-delete">🗑️</i></a>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="card-body">';
                                echo '<p><strong>Empresa:</strong> ' . htmlspecialchars($row['nome_empresa']) . '</p>';
                                echo '<p><strong>CNPJ:</strong> ' . htmlspecialchars($row['documento']) . '</p>';
                                echo '<p><strong>Telefone:</strong> ' . htmlspecialchars($row['telefone']) . '</p>';
                                echo '<p><strong>Data Cadastro:</strong> ' . htmlspecialchars($row['data_cadastro']) . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>Nenhum fornecedor encontrado.</p>';
                        }
                    ?>
                </div>
            </div>

        </section>
    </main>


    <script src="../../assets/js/main.js"></script>                      
</body>
</html>
