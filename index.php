<?php
    include 'serverside/queries/db_queries.php';
    include 'serverside/config/dbConnection.php';
    include 'includes/main-sidebar.php';

    $conn = dbConnection();

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $vencDate = new DateTime();
    $vencDate->modify('-30 day');
    $end_date = $vencDate->format('Y-m-d H:i:s');

    $sql= "SELECT data, SUM(valor) AS valor_diario FROM despesas  WHERE data > '" . $end_date . "' GROUP BY DAY(data)";
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    $x = substr($row['data'],0,10);

    $dataPointsDay[] = array("y" => $row['valor_diario'], "label" => substr($row['data'],0,10));
}

$sql= "SELECT data, SUM(valor) AS valor_diario FROM entradas  WHERE data > '" . $end_date . "' GROUP BY DAY(data)";
$stmt= $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
$x = substr($row['data'],0,10);

$dataPointsDayE[] = array("y" => $row['valor_diario'], "label" => substr($row['data'],0,10));
}

$vencDate->modify('-12 month');
$end_date = $vencDate->format('Y-m-d H:i:s');

$sql= "SELECT data, SUM(valor) AS valor_diario FROM despesas  WHERE data > '" . $end_date . "' GROUP BY MONTH(data)";
$stmt= $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    $x = substr($row['data'],0,10);

    $dataPointsMonth[] = array("y" => $row['valor_diario'], "label" => substr($row['data'],0,10));
}

$sql= "SELECT data, SUM(valor) AS valor_diario FROM entradas  WHERE data > '" . $end_date . "' GROUP BY MONTH(data)";
$stmt= $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    $x = substr($row['data'],0,10);

    $dataPointsMonthE[] = array("y" => $row['valor_diario'], "label" => substr($row['data'],0,10));
}

$sql= "SELECT data, SUM(valor) AS valor_total FROM despesas";
$stmt= $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    $pieDataPoints[] = array("y" => $row['valor_total'], "label" => "DESPESAS");
}

$sql= "SELECT data, SUM(valor) AS valor_total FROM entradas";
$stmt= $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$total = 0;

while($row = $result->fetch_assoc()) {
    $total += $row['valor_total'];
}

$sql= "SELECT total FROM vendas";
$stmt= $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    $total += $row['total'];
}

$pieDataPoints[] = array("y" => $total, "label" => "ENTRADAS");
 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/assets/css/main.css">
    <link rel="stylesheet" href="./public/assets/css/orcamento/orcamento2.css">
    <title>Sistema - Café de Vovô</title>

    <script>
        window.onload = function () {
        
        var chart = new CanvasJS.Chart("chartContainerDay", {
            title: {
                text: "Despesas (DIARIO)"
            },
            axisY: {
                title: "Valor (R$)"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPointsDay, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

        var chart = new CanvasJS.Chart("chartContainerMonth", {
            title: {
                text: "Despesas (MENSAL)"
            },
            axisY: {
                title: "Valor (R$)"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPointsMonth, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();




        var chart = new CanvasJS.Chart("chartContainerDayE", {
            title: {
                text: "Entradas (DIARIO)"
            },
            axisY: {
                title: "Valor (R$)"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPointsDayE, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

        var chart = new CanvasJS.Chart("chartContainerMonthE", {
            title: {
                text: "Entradas (MENSAL)"
            },
            axisY: {
                title: "Valor (R$)"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPointsMonthE, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();


        var chart = new CanvasJS.Chart("pieContainer", {
            theme: "light2",
            animationEnabled: true,
            title: {
                text: "CAIXA"
            },
            data: [{
                type: "pie",
                indexLabel: "{y}",
                yValueFormatString: "\"R$\"#,##0.00",
                indexLabelPlacement: "inside",
                indexLabelFontColor: "#36454F",
                indexLabelFontSize: 18,
                indexLabelFontWeight: "bolder",
                showInLegend: true,
                legendText: "{label}",
                dataPoints: <?php echo json_encode($pieDataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
        
    }
        
    </script>
</head>
<body>

    <?php include('includes/main-sidebar.php'); ?>
    <?php include('includes/topbar.php'); ?>
    
    <main class="content">

    <button onclick="mes()">Dia / Mês</button>
    <div class="navbar" id="navbar"></div>

        <section class="charts">
        <div id="chartContainerDay" style="height: 400px; width: 500px;"></div>
        <div id="chartContainerMonth" style="height: 370px; width: 100%;display:none;"></div>

        <div id="chartContainerDayE" style="height: 400px; width: 500px;"></div>
        <div id="chartContainerMonthE" style="height: 370px; width: 100%;display:none;"></div>

        <div id="pieContainer" style="height: 400px; width: 500px;"></div>
           
        </section>   
    </main>

<script src="./public/assets/js/main.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
    function mes() {
        if (document.getElementById("chartContainerMonth").style.display != 'flex') {
            document.getElementById("chartContainerMonth").style.display = 'flex';
            document.getElementById("chartContainerDay").style.display = 'none';
            document.getElementById("chartContainerMonthE").style.display = 'flex';
            document.getElementById("chartContainerDayE").style.display = 'none';
        } else {
            document.getElementById("chartContainerMonth").style.display = 'none';
            document.getElementById("chartContainerDay").style.display= 'flex';
            document.getElementById("chartContainerMonthE").style.display = 'none';
            document.getElementById("chartContainerDayE").style.display= 'flex';
        }
    }
</script>

</body>
</html>
