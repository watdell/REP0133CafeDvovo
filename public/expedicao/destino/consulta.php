<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/relatorios/relatorio-pessoas/relatorio-pessoas.css">


    <title>Document</title>
</head>
<body>
    <?php include ('../../../serverside/config/dbConnection.php');?>
    <?php include('../../../includes/main-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>
    <?php include ('../../../serverside/queries/db_queries.php');?>




    <main class="content">
        <h2>Consultando Destinos:</h2>

        <div class="card-grid">
            <?php
                $conn = dbConnection();
                $query = getQuery('select_all_destinos');
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                                    //$sql = 'INSERT INTO destino (nome_lugar, CEP, Logradouro, Bairro, Cidade, Estado) VALUES (?,?,?,?,?,?)';
                        echo '<div class="card">';
                        echo '<div class="card-header">';
                        echo '<h3>   ' . htmlspecialchars($row['nome_lugar']) . '</h3>';
                        echo '<div class="actions">';
            
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="card-body">';
                        echo '<p><strong>CEP:</strong> ' . htmlspecialchars($row['CEP']) . '</p>';
                        echo '<p><strong>Logradouro:</strong> ' . htmlspecialchars($row['Logradouro']) . '</p>';
                        echo '<p><strong>Bairro:</strong> ' . htmlspecialchars($row['Bairro']) . '</p>';
                        echo '<p><strong>Cidade:</strong> ' . htmlspecialchars($row['Cidade']) . '</p>';
                        echo '<p><strong>Estado:</strong> ' . htmlspecialchars($row['Estado']) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Nenhum destino encontrado.</p>';
                }
            ?>
        </div>





    </main>


    <?php


    ?>
    
</body>
</html>