<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../../public/assets/css/cssdestino.css">
    <title>Document</title>
</head>
<body>

      <?php include('../../../../includes/main-sidebar.php'); ?>
      <?php include('../../../../includes/topbar.php'); ?>

    <div class="content">''
     <h1>Cadastro de Correios</h1>
     <fieldset id="bloco_cep">
     ID Destino: <input type="text" id="correio" name="correio" >
     ID Venda:  <input type="text" id="pd" name="pd" >
     Quantidade:(U)<input type="text" id="qnt" name="qnt" >
     Distancia (em km):<input type="text" id="km" name="km" >
     Taxa:<input type="text" id="tx" name="tx" >
     Custo: <input type="text" id="custo" name="custo" >
     <div class="buttons-div">
     <button type="button" class="button" id="tx" name="tx" onclick="acao()">Enviar</button>
     <button type="button" class="button" onclick="acao()">Registrar</button>
     <button type="button" onclick="voltar()" class="button">Voltar</button>
     </div>
     
</fieldset>
</div>
</body>
    
 <script>
    function voltar(){
        window.location.href='../../index.php';
    }
    function acao (){
       var Produtos = parseFloat(document.getElementById("pd").value); 
        var Quantidade = parseFloat(document.getElementById("qnt").value);
        var kmd = parseFloat(document.getElementById("km").value);
        var taxa = parseFloat(document.getElementById("tx").value);
       var cal1 = (Quantidade);
        var cal2 = (kmd*taxa);
        var total = (cal1*cal2);
        window.alert("R$" + total);

    }     
 </script>

 
</html>