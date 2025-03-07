<?php
// Inicia uma sessão para garantir que o arquivo pagamento.php acesse variáveis de processamento-pag.php
session_start();

$codVenda = isset($_SESSION['codVenda']) ? $_SESSION['codVenda'] : "";
$codOrcamento = isset($_SESSION['codOrcamento']) ? $_SESSION['codOrcamento'] : "";
$produtos = isset($_SESSION['produtos']) ? $_SESSION['produtos'] : "";
$precoTotal = isset($_SESSION['precoTotal']) ? $_SESSION['precoTotal'] : "";
$desconto = $precoTotal * 0.9;
$aVista = number_format($desconto,2,",",".");
$total = number_format($precoTotal,2,",",".");
?>

<!-- se você tiver alguma solução melhor para passar esses valores para o javascript, ficaria feliz em ouvir -->
<a id="cod-venda" hidden><?php echo "$codVenda"?></a>
<a id="cod-orcamento" hidden><?php echo "$codOrcamento"?></a>
<a id="discount" hidden><?php echo "$desconto"?></a>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/pagamento/pagamento.css?v=<?php echo time(); ?>"> <!-- the code is adding a query string in the css file link -->
    <title>Sistema - Café de Vovô</title> <!-- Temporario(?) -->
</head>
<body>

    <?php include('../../../includes/main-sidebar.php'); ?> <!-- Temporario(?) -->
    <?php include('../../../includes/topbar.php'); ?>

    <main class="content">
        <div class="site-content">
            <div class="main-box" id="main">

                <ul class="nav-bar">
                    <li>
                        <a id="arrow-1">Escolha<div class="box"></div><div class="arrow right"></div></a>
                    </li>
                    <li>
                        <a id="arrow-2"><div class="arrow left"></div>Pagamento<div class="box"></div><div class="arrow right"></div></a>
                    </li>
                    <li>
                        <a id="arrow-3"><div class="arrow left"></div>Conclusão</a>
                    </li>
                </ul>

                <div class="form-display" id="purchase-type-form" style="display:flex;">
                    <div>
                        <label for="select-type">Forma de Pagamento:</label>
                        <select id="select-type" name="select-type" onchange="ShowButton()">
                            <option value="0" selected disabled hidden>Selecione a forma de pagamento</option>
                            <option value="1">Cartão</option>
                            <option value="2">Dinheiro</option>
                            <option value="3">Pix</option>
                        </select>
                    </div>
                    <input class="next-button" id="type-next" type="button" value="Prosseguir" onclick="NextScreen()">
                </div>

                <div class="form-display" id="card-form">
                    <div>
                        <label for="select-card">Tipo do Cartão:</label>
                        <select id="select-card" name="select-card" onchange="CardType()">
                            <option value="0" selected disabled hidden>Selecione o tipo de cartão</option>
                            <option value="1">Débito</option>
                            <option value="2">Crédito</option>
                        </select>

                        <a id="debt-choice" style="display:none;">Você escolheu débito</a>
                        <a id="credit-choice" style="display:none;">Você escolheu crédito</a>
                        <!--
                        <form id="cupom-form" action="cupom.php" method="post">
                            <label for="cupom">Cupom de desconto:</label>
                            <input id="cupom" name="cupom" type="text" onchange="document.getElementById('cupom-form').submit()">
                        </form>
                        -->

                    </div>
                    
                    <input class="next-button" id="card-next" type="button" value="Prosseguir" onclick="ConfirmScreen()">
                </div>

                <div class="form-display" id="money-form">
                    <div>
                        <label>Valor de compra: </label><a>R$<?php echo "$aVista"?> (10% de desconto)</a><br><br>
                        <label for="client-money">Valor pago pelo cliente:</label>
                        <input id="client-money" name="client-money" type="number" onchange="CalcChange()">

                        <a id="change" style="display:none;"></a>

                        <!--
                        <form id="cupom-form" action="cupom.php" method="post">
                            <label for="cupom">Cupom de desconto:</label>
                            <input id="cupom" name="cupom" type="text" onchange="document.getElementById('cupom-form').submit()">
                        </form>
                        -->

                    </div>

                    <input class="next-button" id="money-next" type="button" value="Prosseguir" onclick="ConfirmScreen()">
                </div>

                <div class="form-display" id="pix-form">
                    <div style="display:flex; flex-direction:column; align-items: center;">
                        <label>Valor total: </label><a>R$<?php echo "$aVista"?> (10% de desconto)</a><br>
                        <label>Escaneie o QR-Code:</label><br>
                        <img style="width: 250px; height: 250px;" src="../../assets/images/qr_code_fake.png"><br>
                        <a style="font-size: 0.9em;">Código copia e cola: 'Jgod12-sNog2-aSjhrO-12G3ga'</a><br>

                        <!--
                        <form id="cupom-form" action="cupom.php" method="post">
                            <label for="cupom">Cupom de desconto:</label>
                            <input id="cupom" name="cupom" type="text" onchange="document.getElementById('cupom-form').submit()">
                        </form>
                        -->

                    </div>

                    <input class="next-button" id="pix-next" type="button" value="Prosseguir" style="visibility: visible;" onclick="ConfirmScreen()">
                </div>

                <div class="form-display" id="confirm-form">
                    <div style="margin: 20px;">
                        <label style="display: block; width: 100%; text-align: center;">Obrigado pela compra!</label>
                        <br>
                        <div class="purchase-info">
                            <div style="margin: 10px;">
                                <label>Código da Venda: </label><a><?php echo "$codVenda"?></a><br>
                                <label>Código do Orçamento: </label><a><?php echo "$codOrcamento"?></a><br>
                                <label>Itens Vendidos: </label><br><br><hr>
                                <?php
                                    foreach ($produtos as $produto) {
                                        $nome = $produto[0];
                                        $preUni = number_format($produto[1],2,",",".");
                                        $quant = $produto[2];
                                        $preToPro = number_format($produto[3],2,",",".");
                                        echo "<div style=\"display: flex; justify-content: space-between;\"><div><label>$nome: </label><a>Preço Uni.: R\$$preUni, Quant.: $quant &nbsp </a></div><a>Total: R\$$preToPro</a></div>" . "<hr>";
                                    }
                                ?>
                                <br><label>Valor Total: </label><a>R$<?php echo "$total"?></a><br>
                                <label>À vista: </label><a>R$<?php echo "$aVista"?> (10% de desconto)</a><br>
                                <a id="valor-pago-cliente" style="display: none"></a>
                                <a id="troco-cliente" style="display: none"></a>
                            </div>
                        </div>
                    </div>

                    <input class="next-button" id="confirm" type="button" value="Confirmar" onclick="ConfirmPurchase()">
                </div>

            </div>
        </div>
    </main>
    <script>
        // Define a tela inicial como 1 e a transforma em ativa
        var screen = 1;
        function ShowButton() {
            document.getElementById("type-next").style.visibility = "visible";
            ChangeProgress("1", "activate");
        }

        function ChangeProgress(element, wtd) {
            arrow_1 = document.getElementById("arrow-1");
            arrow_2 = document.getElementById("arrow-2");
            arrow_3 = document.getElementById("arrow-3");

            switch(element) {
                case "1":
                    var element = arrow_1;
                    break;
                case "2":
                    var element = arrow_2;
                    break;
                case "3":
                    var element = arrow_3;
                    break;
                default:
                    //pass
            }

            if (wtd == "activate") {
                element.classList.add("active");
            } else if (wtd == "desactivate") {
                element.classList.remove("active");
            }
        }

        function NextScreen() {
            main = document.getElementById("main");
            type_form = document.getElementById("purchase-type-form");
            card_form = document.getElementById("card-form");
            money_form = document.getElementById("money-form");
            pix_form = document.getElementById("pix-form");
            select_type = document.getElementById("select-type").value;

            if (select_type == 1) {
                type_form.style.display = "none";
                card_form.style.display = "flex";
                money_form.style.display = "none";
                pix_form.style.display = "none";
                screen = 2;
                main.style.height = "300px";
            } else if (select_type == 2) {
                type_form.style.display = "none";
                card_form.style.display = "none";
                money_form.style.display = "flex";
                pix_form.style.display = "none";
                screen = 3;
                main.style.height = "300px";
            } else if (select_type == 3) {
                type_form.style.display = "none";
                card_form.style.display = "none";
                money_form.style.display = "none";
                pix_form.style.display = "flex";
                main.style.height = "600px";
                screen = 4;
                ChangeProgress("2", "activate");
            }
        }

        function ConfirmScreen() {
            document.getElementById("purchase-type-form").style.display = "none";
            document.getElementById("card-form").style.display = "none";
            document.getElementById("money-form").style.display = "none";
            document.getElementById("pix-form").style.display = "none";

            document.getElementById("confirm-form").style.display = "flex";
            main.style.height = "auto";
            main.style.width = "auto";
            document.getElementById("confirm").style.visibility = "visible";

            ChangeProgress("3", "activate");
        }

        function CardType() {
            card_select = document.getElementById("select-card").value;
            if (card_select == 1) {
                document.getElementById("debt-choice").style.display = "block";
                document.getElementById("credit-choice").style.display = "none";
            } else {
                document.getElementById("credit-choice").style.display = "block";
                document.getElementById("debt-choice").style.display = "none";
            }

            document.getElementById("card-next").style.visibility = "visible";
            ChangeProgress("2", "activate");
        }

        function CalcChange() {
            client_money = document.getElementById("client-money").value;
            total_value = parseFloat(document.getElementById("discount").innerHTML);
            console.log(total_value);

            if (client_money > total_value) {
                var change = client_money - total_value;
            }
            console.log(change);
            document.getElementById("change").innerHTML = "Troco do cliente: R$" + change.toFixed(2);
            document.getElementById("change").style.display = "block";

            document.getElementById("valor-pago-cliente").innerHTML = "Valor pago pelo cliente: R$" + parseFloat(client_money).toFixed(2);
            document.getElementById("valor-pago-cliente").style.display = "block";
            document.getElementById("troco-cliente").innerHTML = "Valor do troco para o cliente: R$" + change.toFixed(2);
            document.getElementById("troco-cliente").style.display = "block";

            document.getElementById("money-next").style.visibility = "visible";
            ChangeProgress("2", "activate");
        }

        function ToReal() {
            let value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos
            value = value.replace(/(\d{2})$/, ',$1'); // Coloca a vírgula antes dos dois últimos números
            value = value.replace(/(?=(\d{3})+(\D))\B/g, '.'); // Adiciona ponto como separador de milhar
            input.value = 'R$ ' + value; // Adiciona o prefixo "R$" e retorna o valor formatado
        }
    </script>
</body>
</html>

<?php
// Limpando as variáveis da sessão para não aparecerem sem carregamentos subsequentes
unset($_SESSION['codVenda']);
unset($_SESSION['codOrcamento']);
//unset($_SESSION['produtos']);
//unset($_SESSION['precoTotal']);
?>