<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Sistema de Vendas</title>
</head>
<body>
    <?php include('../../../includes/main-sidebar.php'); ?>

    <header class="topbar">Sistema de Vendas</header>
    <main class="content">
        <?php
            include('../../../serverside/config/dbConnection.php'); 
            $conn = dbConnection();
            
            // Buscar clientes
            $stmtClientes = $conn->prepare("SELECT * FROM pessoa ORDER BY nome ASC");
            $stmtClientes->execute();
            $resultClientes = $stmtClientes->get_result();

            // Buscar produtos
            $stmtProdutos = $conn->prepare("SELECT * FROM produto ORDER BY nome ASC");
            $stmtProdutos->execute();
            $resultProdutos = $stmtProdutos->get_result();
        ?>  

        <form id="formulario-geral" method="post" class="form-group" action="./registrar-venda.php" enctype="multipart/form-data">
            <section>
                <fieldset>
                    <label for="cliente">Cliente</label>
                    <select type="text" name="cliente" id="cliente">
                        <?php while ($row = $resultClientes->fetch_assoc()) { ?>
                            <option value="<?= $row['pessoa_id']; ?>"><?= $row['nome']; ?></option>
                        <?php } ?>   
                    </select>
                </fieldset>
            </section>

            <section id="produtos" class="tabcontent"> 
                <fieldset class="fieldset">
                    <legend>Itens da venda</legend>
                    <table border="1">
                        <tr>
                            <th>Produto</th>
                            <th>Qntd</th>   
                            <th>Valor Unit</th>
                            <th>Sub Total</th> 
                            <th>Ação</th>
                        </tr>
                        <tr id="linhaFixa">
                            <td>
                                <div id="div-produtos">
                                    <div class="produto">
                                        <select style="width: 70%;" class="produto-select" name="produto[]" id="select-produto-0" onchange="atualizarPreco(this)">
                                            <?php while ($row = $resultProdutos->fetch_assoc()) { ?>
                                                <option value="<?= $row['produto_id']; ?>" data-preco="<?= $row['preco_venda']; ?>"><?= $row['nome']; ?></option>
                                            <?php } ?>               
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td><input class="produto-qntd" type="number" name="qntd-produto[]" id="produto-qntd" style="width: 60px;" step="1" min="1" value="1" oninput="calcularSubtotal(this)"></td>
                            <td><input class="valor-unit" type="text" name="valor-unit[]" id="valor-unit" style="width: 70px;" readonly></td>
                            <td><input class="sub-total" type="text" name="sub-total[]"  id="sub-total" style="width: 70px;" readonly></td>
                            <td><button type="button" onclick="deleteInsumoDiv(this)" class="icon-delete">🗑️</button></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">
                                Desconto: <input style="width:60px;" class="desconto" min="0" type="number" name="desconto" id="desconto" style="width: 50px;" step="1" value="0" oninput="atualizarTotal()"> %
                            </td>
                        </tr>   
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2" style="text-align: center;">
                                <span class="total">Total: R$</span> <input type="text" id="total" name="total" readonly>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <button id="add-produto" type="button" class="register-btn">Adicionar Produto</button>
                </fieldset>
                <br>
                <fieldset>
                    
                </fieldset>
                <br>
            </section>
            
            <button id="Registrar Venda" type="submit" class="register-sell">Registrar Venda</button>
        </form>
        <br>
        <h2>Calcular Frete</h2>
        <form id="freteForm">
            <label>CEP Origem:</label>
            <input type="text" id="cep_origem" name="cep_origem" required><br><br>

            <label>CEP Destino:</label>
            <input type="text" id="cep_destino" name="cep_destino" required><br><br>

            <label>Peso (kg):</label>
            <input type="number" id="peso" name="peso" step="0.1" required><br><br>

            <label>Valor Declarado (R$):</label>
            <input type="number" id="valor" name="valor_declarado" step="0.01" required><br><br>

            <label>Dimensões (cm):</label><br>
            <label>Largura:</label> <input type="number" id="largura" name="largura" required>
            <label>Altura:</label> <input type="number" id="altura" name="altura" required>
            <label>Comprimento:</label> <input type="number" id="comprimento" name="comprimento" required><br><br>

            <button type="submit">Calcular Frete</button>
        </form>
        <br><br>
        <h3>Resultado:</h3>
        <p id="resultado"></p>
        <br>
    </main>

    <script src="./js/venda.js"></script>    
</body>
</html>
