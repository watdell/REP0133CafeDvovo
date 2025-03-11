<?php
    include 'serverside/queries/db_queries.php';
    include 'serverside/config/dbConnection.php';
    include 'includes/main-sidebar.php';

    $conn = dbConnection();

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    function DateMod($mod) {
        $vencDate = new DateTime();
        $vencDate->modify($mod);
        return $vencDate->format('Y-m-d H:i:s');
    };

    function SelectData($table,$mod) {
        $conn = dbConnection();

        $sql= "SELECT data, SUM(valor) AS valor_diario FROM $table WHERE data > '" . DateMod($mod) . "' GROUP BY DAY(data)";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result(); 

        while($row = $result->fetch_assoc()) {
            $x[] = array("y" => $row['valor_diario'], "label" => substr($row['data'],0,10));
        }
        return $x;
    };

    $dataPointsDay = SelectData('despesas','-30 day');
    $dataPointsDayE = SelectData('entradas','-30 day');
    $dataPointsMonth = SelectData('despesas','-12 month');
    $dataPointsMonthE = SelectData('entradas','-12 month');

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

        function BuildCanvas(id,name,returnal,color) {
            var chart = new CanvasJS.Chart(id, {
                title: {
                    text: name
                },
                axisY: {
                    title: "Valor (R$)"
                },
                data: [{
                    lineColor: color,
                    type: "line",
                    dataPoints: returnal
                }]
            });
            chart.render();
        }

        BuildCanvas("chartContainerDay","Despesas (DIARIO)",<?php echo json_encode($dataPointsDay, JSON_NUMERIC_CHECK); ?>,'red');
        BuildCanvas("chartContainerMonth","Despesas (MENSAL)",<?php echo json_encode($dataPointsMonth, JSON_NUMERIC_CHECK); ?>,'red');
        BuildCanvas("chartContainerDayE","Entradas (DIARIO)",<?php echo json_encode($dataPointsDayE, JSON_NUMERIC_CHECK); ?>,'green');
        BuildCanvas("chartContainerMonthE","Entradas (MENSAL)",<?php echo json_encode($dataPointsMonthE, JSON_NUMERIC_CHECK); ?>,'green');

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
