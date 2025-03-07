<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>

    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/servicos/cadastro-servicos/cadastro_servico.css">
</head>

<body>
    <?php include('../../../includes/main-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>

    <div class="content">
        <h1>Registrar Compras</h1>

        <form id="form" method="post" action="processar_compra.php">
            <label for="item">Escolha o item para compra: </label>
            <select id="item" name="item" required>
                <option value="cafe_graos">Café em Grãos - R$ 0.05/g</option>
                <option value="leite_po">Leite em Pó - R$ 0.10/g</option>
                <option value="chocolate_po">Chocolate em Pó - R$ 0.15/g</option>
            </select>

            <label for="quantidade">Quantidade (g): </alabel>
            <input type="number" id="quantidade" name="quantidade" min="1" required>

            <label for="preco">Preço Total: </label>
            <input type="text" id="preco" name="preco" readonly>

            <button type="button" onclick="calcularPreco()">Calcular Preço</button>
            <button type="submit">Confirmar Compra</button>
            <button type="button" onclick="cancelar()">Cancelar</button>
        </form>

        <div id="saldo">
            <h3>Saldo da Empresa: R$ <?php echo number_format($saldo_empresa, 2, ',', '.'); ?></h3>
        </div>
    </div>

    <script>
        const precos = {
            "cafe_graos": 0.05,
            "leite_po": 0.10,
            "chocolate_po": 0.15
        };

        function calcularPreco() {
            const item = document.getElementById("item").value;
            const quantidade = parseFloat(document.getElementById("quantidade").value);
            const preco = precos[item] * quantidade;

            if (!isNaN(preco)) {
                document.getElementById("preco").value = "R$ " + preco.toFixed(2);
            } else {
                alert("Insira uma quantidade válida.");
            }
        }

        function cancelar() {
            document.getElementById("form").reset();
            document.getElementById("preco").value = "";
        }
    </script>
</body>

</html>
