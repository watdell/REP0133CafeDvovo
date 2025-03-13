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
        $y = [];
        $x = [];
        $x1 = [];
        $y1 = [];

        if ($mod == '-30 day') {
            $TypeDate = 'GROUP BY DAY(data)';
        } else {
            $TypeDate = 'GROUP BY MONTH(data)';
        }

        $sql= "SELECT data, SUM(valor) AS valor_diario FROM $table WHERE data > '" . DateMod($mod) . "' $TypeDate ORDER BY data ASC";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result(); 

        while($row = $result->fetch_assoc()) {
            if ($table == 'entradas') {
                if ($mod == '-30 day') {
                    $x[] = array($row['valor_diario']);
                    $y[] = array(substr($row['data'],0,10));
                    } else { 
                    $x[] = array($row['valor_diario']);
                    $y[] = array(substr($row['data'],0,7));
                    }
            } else {
                if ($mod == '-30 day') {
                    $x[] = array("y" => $row['valor_diario'] * -1, "label" => substr($row['data'],0,10));
                    } else { 
                    $x[] = array("y" => $row['valor_diario'] * -1, "label" => substr($row['data'],0,7));
                    }
            }
        }

        $sql2= "SELECT data_venda, SUM(total) AS valor_diario FROM vendas WHERE data_venda > '" . DateMod($mod) . "' GROUP BY DAY(data_venda) ORDER BY data_venda ASC";
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute();
        $result2 = $stmt2->get_result(); 

        while($row2 = $result2->fetch_assoc()) {
            if ($table == 'entradas') {
                if ($mod == '-30 day') {
                    $x1[] = array($row2['valor_diario']);
                    $y1[] = array(substr($row2['data_venda'],0,10));
                } else { 
                    $x1[] = array($row2['valor_diario']);
                    $y1[] = array(substr($row2['data_venda'],0,7));
                }
            
                echo json_encode($x1);

                echo json_encode($y1);
            }
        }
        return [$x, $y, $x1, $y1];
    };

    $dataPointsDay = SelectData('despesas','-30 day');
    $dataPointsDayE = SelectData('entradas','-30 day');
    $dataPointsMonth = SelectData('despesas','-12 month');
    $dataPointsMonthE = SelectData('entradas','-12 month');

$sql= "SELECT data, SUM(valor) AS valor_total FROM despesas where data > '" . DateMod('-30 day') . "'";
$stmt= $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    $pieDataPoints[] = array("y" => $row['valor_total'], "label" => "DESPESAS");
}

$sql= "SELECT data, SUM(valor) AS valor_total FROM entradas where data > '" . DateMod('-30 day') . "'";
$stmt= $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$total = 0;

while($row = $result->fetch_assoc()) {
    $total += $row['valor_total'];
}

$sql= "SELECT total FROM vendas where data_venda > '" . DateMod('-30 day') . "'";
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
    <link rel="stylesheet" href="./public/assets/css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./public/assets/css/orcamento/orcamento2.css?v=<?php echo time(); ?>">
    <title>Sistema - Café de Vovô</title>

    <script>
        window.onload = function () {

        function BuildCanvas(id,name,returnal,color) {
            
            CanvasJS.addColorSet("Custom",
                [//colorSet Array
                "#483327",
                "#b08c3c"              
                ]);
            
            var chart = new CanvasJS.Chart(id, {
                title: {
                    text: name
                },
                axisY: {
                    title: "Valor (R$)"
                },
                backgroundColor: "transparent",
                data: [{
                    lineThickness: 3,
                    lineColor: color,
                    markerColor: color,
                    markerSize: 15,
                    markerBorderColor:"#000000",
                    type: "line",
                    dataPoints: returnal
                }]
            });
            chart.render();
        }

        BuildCanvas("chartContainerDay","Despesas (DIARIO)",<?php echo json_encode($dataPointsDay[0], JSON_NUMERIC_CHECK); ?>,'red');
        BuildCanvas("chartContainerMonth","Despesas (MENSAL)",<?php echo json_encode($dataPointsMonth[0], JSON_NUMERIC_CHECK); ?>,'red');
        BuildCanvas("chartContainerDayE","Entradas (DIARIO)",<?php echo json_encode($dataPointsDayE[0], JSON_NUMERIC_CHECK); ?>,'green');
        BuildCanvas("chartContainerMonthE","Entradas (MENSAL)",<?php echo json_encode($dataPointsMonthE[0], JSON_NUMERIC_CHECK); ?>,'green');

        var chart = new CanvasJS.Chart("pieContainer", {
            theme: "light2",
            animationEnabled: true,
            title: {
                text: "CAIXA"
            },
            colorSet: "Custom",
            backgroundColor: "transparent",
            data: [{
                type: "pie",
                indexLabel: "{y}",
                yValueFormatString: "\"R$\"#,##0.00",
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
    
    <main class="content" style="width:90%">

    <!-- <button onclick="mes()">Dia / Mês</button> -->
    <div class="navbar" id="navbar"></div>

        <section class="charts">
        <div id="inicial" style="width:100%;">
            <div class="table" style="display:flex;justify-content:space-evenly">
        <div class="subtotal" style="display:flex;flex-direction:column;width:40%">
            <a style="width:40%;font-size:30px">Lucro Líquido:  </a>
                <a id='col_cal' style="width:40%;font-size:30px"><?php

                    $sql= "SELECT valor FROM despesas where data > '" . DateMod('-30 day') . "'";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $subtotal = 0;

                    while($row = $result->fetch_assoc()) {
                        $subtotal = $subtotal + $row['valor'];
                    }

                    $sql= "SELECT valor FROM entradas where data > '" . DateMod('-30 day') . "'";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while($row = $result->fetch_assoc()) {
                        $subtotal = $subtotal + $row['valor'];
                    }

                    $sql= "SELECT total FROM vendas where data_venda > '" . DateMod('-30 day') . "'";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while($row = $result->fetch_assoc()) {
                        $subtotal = $subtotal + $row['total'];
                    }

                    echo "R$ "  .  number_format($subtotal, 2, ',', '.');
                    ?></a><br><br>
                    <a style="width:40%;font-size:30px">Despesas:</a>
                    <a style="width:40%;font-size:30px;color:#8e0321"><?php

                    $sql= "SELECT valor FROM despesas where data > '" . DateMod('-30 day') . "'";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $subtotal = 0;

                    while($row = $result->fetch_assoc()) {
                        $subtotal = $subtotal + $row['valor'];
                    }
                    echo "R$ "  .  number_format($subtotal, 2, ',', '.');
                    ?></a><br><br>
                    <a style="width:40%;font-size:30px">Entradas:</a>
                    <a style="width:40%;font-size:30px;color:#0d8e03"><?php
                    $subtotal = 0;

                    $sql= "SELECT valor FROM entradas where data > '" . DateMod('-30 day') . "'";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while($row = $result->fetch_assoc()) {
                        $subtotal = $subtotal + $row['valor'];
                    }

                    echo "R$ "  .  number_format($subtotal, 2, ',', '.');
                    ?></a><br><br>
                    <a style="width:40%;font-size:30px">Vendas:</a>
                    <a style="width:40%;font-size:30px;color:#0d8e03"><?php
                    $subtotal = 0;

                        $sql= "SELECT total FROM vendas where data_venda > '" . DateMod('-30 day') . "'";
                        $stmt= $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while($row = $result->fetch_assoc()) {
                            $subtotal = $subtotal + $row['total'];
                        }
                    echo "R$ "  .  number_format($subtotal, 2, ',', '.');
                    ?></a>
                </div>
            <div id="pieContainer" style="height: 400px; width: 50%;"></div>
            </div>
        </div>

        <div class="itens_shown" style="margin: 0;">

        <div id="chartContainerDay" style="height: 400px; width: 48%;"></div>

        <div id="chartContainerDayE" style="height: 400px; width: 48%;"></div> 

        </div>

        <hr style="width:100%;border: 1px dashed #483327">


        <div class="itens_shown" style="margin: 0;">

        <div id="chartContainerMonth" style="height: 400px; width: 48%;"></div>

        <div id="chartContainerMonthE" style="height: 400px; width: 48%;"></div>

        </div>

        
           
        </section>   
        <br>
    </main>

<script src="./public/assets/js/main.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
    function calcularTotal() {
        if (document.getElementById('col_cal').innerHTML[3] != '-') {
            document.getElementById('col_cal').style.color = '#0d8e03';
        } else {
            document.getElementById('col_cal').style.color = '#8e0321';
        }
        if (document.getElementById('col_cal').innerHTML.length > 20) {
            document.getElementById('col_cal').innerHTML = 'Verifique valores';
        }
    }
    calcularTotal();
</script>

</body>
</html>