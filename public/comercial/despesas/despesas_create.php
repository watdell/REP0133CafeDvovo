<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/assets/css/despesas/style.css?v=<?php echo time(); ?>">
    <script src="../../../public/assets/js/comercial/despesa/despesa.js?v=<?php echo time(); ?>"></script>
    <title>Document</title>

    <?php
        include '../../../serverside/queries/db_queries.php';
        include '../../../serverside/config/dbConnection.php';
        include '../../../includes/main-sidebar.php';

        $conn = dbConnection();

        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }
        
    ?>

</head>
<body>
    <?php include('../../../includes/main-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>

    <main class="content" style="justify-self: center;width:40%">
        <div class="table" style="flex-direction:column;min-height:400px">
                <div class="innerdiv"> 
                    <h1>Registrar Nova Despesa</h1>
                    <button onclick="location.href='despesas.php'">VOLTAR</button>
                </div>

                <br><br>

                <form action="despesas_table.php" id="forms" method="POST" style='width:100%'>
                    <div class="innerdiv">
                        <label for="tipo">Tipo de Despesa:</label>
                        <select id="tipo" name="tipo" required onchange='setCat()'>
                            <option value="fixo">Fixo</option>
                            <option value="variavel">Variavel</option>
                        </select>


                        <label for="cat">Categoria:</label>


                        <select id='catf' name="catf" onchange='Stuff("catf")' style='display:none'>
                            <?php
                                $sql = "SELECT nome FROM despesa_categoria WHERE tipo = 'fixo'";

                                $result = $conn->query($sql);

                            while($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php  echo $row['nome'];?>"> <?php  echo $row['nome']; ?> </option>
                                <?php
                            }
                            ?>
                        </select>

                        <select id='catv' name="catv" onchange='Stuff("catv")' style='display:none'>
                            <?php
                                $sql = "SELECT nome FROM despesa_categoria WHERE tipo = 'variavel'";

                                $result = $conn->query($sql);

                            while($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php  echo $row['nome'];?>"> <?php  echo $row['nome']; ?> </option>
                                <?php
                            }
                            ?>
                        </select>

                        </div>

                        <br><br>

                        <div class="innerdiv">
                        <label for="nome">Descrição:</label>
                        <input type="text" id="desc" name="desc" maxlength="255" required>

                        <label for="nome">Valor:</label>
                        <input type="number" step='0.01' id="val" name="val" maxlength="255" required onchange='thewarn()'>
                        </div>

                        <br>
                        <a id='valwarn' class='valwarn'>VALOR SERÁ REGISTRADO COMO NEGATIVO</a>
                        <br>

                        <div class="innerdiv" style="justify-content:center; margin: 0px 10px; gap: 10px;">

                        <button class="register-btn" type="submit"  style="width:100%;">Registrar Despesa</button>

                        </div>

                </form>

                <div class="innerdiv" style="justify-content:center; margin: 0px 10px; gap: 10px;">

                <div class="itens_shown" style="justify-content:space-evenly;align-content:center; gap: 10px;padding-top: 10px">
                    <button onclick="location.href='despesas_cat.php'" style="width:100%;align-self:center">CRIAR CATEGORIA</button>
                    <form action="despesas_cat_del.php" method="post" style="width:100%;">
                        <input type="text" id="catd" name="catd" maxlength="255" hidden>
                        <button type="submit" style="width:100%;">DELETAR CATEGORIA</button>
                    </form>
                </div>
                </div>

        </div>
    </main>
<script src="../public/assets/js/main.js"></script>
<script>
    document.getElementById('tipo').value = getCookie('tipo');

    if (document.getElementById('tipo').value == 'fixo') {
        document.getElementById('catf').style.display = 'flex';
        document.getElementById('catv').style.display = 'none';

        Stuff('catf');
    } else {
        document.getElementById('catf').style.display = 'none';
        document.getElementById('catv').style.display = 'flex';

        Stuff('catv')
    }
    </script>
</body>
</html>