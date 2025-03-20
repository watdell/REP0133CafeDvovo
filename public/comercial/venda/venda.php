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

        <form id="formulario-geral" method="post" class="form-venda" action="./registrar-venda.php" enctype="multipart/form-data">
            <section>
                <fieldset>
                    <legend>Cliente</legend>
                    <select style="width: 34.5%" type="text" name="cliente" id="cliente">
                        <?php while ($row = $resultClientes->fetch_assoc()) { ?>
                            <option value="<?= $row['pessoa_id']; ?>"><?= $row['nome']; ?></option>
                        <?php } ?>   
                    </select>
                </fieldset>
            </section>

            <section id="produtos" class="tabcontent"> 
                <fieldset class="fieldset">
                    <legend>Itens da venda</legend>
                    <table>
                        <tr style="border-radius: 5px;">
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
                            <td><button type="button" class="button-smal" onclick="deleteInsumoDiv(this)" class="icon-delete">🗑️</button></td>
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
                                <div class="total-div">
                                    <span style="margin-top: 8px;" class="total">Total: R$ &nbsp;</span> <input type="text" style="width: 100px; border: none" id="total" name="total" readonly>
                                </div>
                               
                            </td>
                        </tr>
                    </table>
                    <br>
                    <button id="add-produto" type="button" class="register-btn button-big">Adicionar Produto</button>
                </fieldset>
                                                
                <br>
            </section>
            <section class="container-frete">
                <fieldset class="field-container-frete">
                    <legend>Calcular Frete</legend>
                    
                    <div class="form-group">
                        <label for="cep_origem">CEP de Origem:</label>
                        <input type="text" id="cep_origem" name="cep_origem" required>
                    </div>

                    <div class="form-group">
                        <label for="cep_destino">CEP de Destino:</label>
                        <input type="text" id="cep_destino" name="cep_destino" required>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group">
                            <label for="peso">Peso (kg):</label>
                            <input type="text" id="peso" name="peso" required>
                        </div>

                        <div class="form-group">
                            <label for="valor_declarado">Valor Declarado (R$):</label>
                            <input type="text" id="valor_declarado" name="valor_declarado" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="largura">Largura (cm):</label>
                            <input type="text" id="largura" name="largura" required>
                        </div>

                        <div class="form-group">
                            <label for="altura">Altura (cm):</label>
                            <input type="text" id="altura" name="altura" required>
                        </div>

                        <div class="form-group">
                            <label for="comprimento">Comprimento (cm):</label>
                            <input type="text" id="comprimento" name="comprimento" required>
                        </div>
                    </div>
                    <br>
                    <button id="calcular-frete-btn" class="button-big" type="button">Calcular Frete</button>
                </fieldset>
                <fieldset class="field-result">
                    <legend>Resultado</legend>
                    <div id="resultado" style="margin-top: 20px; padding: 10px; border-radius: 10px; border: 1px solid #ccc;"></div>
                </fieldset>     
            </section>
            <br>
            <section>
            <fieldset>
                <legend>Data Estimada de Entrega</legend>
                <div style="display: flex; flex-direction:row;">
                    <span style="margin-top: 7px;">Entrega prevista para:</span> &nbsp; <input type="text" style="border: none; width: 20%; font-weight:bold; font-size:16px;" name="data-entrega" id="data-entrega" readonly required>
                </div>
                <input name="dataFormatoBanco" id="dataFormatoBanco" type="text" style="display: none;">
            </fieldset>
            </section>

            <input id='nome-frete' style='display:none;' name='nome-frete' type="text">
            <input id='prazo-frete' style='display:none;' name='prazo-frete' type="text">
            <input id='valor-frete' style='display:none;' name='valor-frete' type="text">

            <br>

            <button id="Registrar Venda" type="submit" class="register-sell button-big ">Registrar Venda</button>
            
        </form>
        
        <br>

    </main>

    <script src="./js/venda.js"></script>    
</body>
</html>