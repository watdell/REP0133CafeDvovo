<?php
function createChart($id, $title, $dataPoints, $color) {
    ?>
    <script>
        window.onload = function () {
            var chart = new CanvasJS.Chart("<?php echo $id; ?>", {
                title: {
                    text: "<?php echo $title; ?>"
                },
                axisY: {
                    title: "Valor (R$)"
                },
                backgroundColor: "transparent",
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>,
                    lineThickness: 3,
                    lineColor: "<?php echo $color; ?>",
                    markerColor: "<?php echo $color; ?>",
                    markerSize: 15
                }]
            });
            chart.render();
        }
    </script>
    <?php
}
?>
