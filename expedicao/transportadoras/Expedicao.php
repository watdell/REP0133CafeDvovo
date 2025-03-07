<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../../public/assets/css/cssdestino.css">
    <title>Document</title>
    <style>
      .checkboxes {
        display:flex;
        flex-direction: column;
      }
    

        </style>
</head>
<body>

    <?php include('../../../includes/main-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>

    <?php include('../../../serverside/config/dbConnection.php'); 
    ?>


  

    <div class="content">
        <form>
        <h1>Expedição</h1>
          <fieldset>
            
              ID Destino:  
              <select id='destino' name='destino'>
                <option>1</option>
                <option>2</option>
                <option>3</option>
              </select>
              ID Venda:  
              <select id='vendas' name='vendas' onchange="this.form.submit()">
                <option>1</option>
                <option>2</option>
                <option>3</option>
              </select>

                  <fieldset>
                    <legend>Itens</legend>
                      <div>
                      <form method="get">
                      <?php
                          $conn = dbConnection();
                            if (isset($_GET['vendas'])){
                              echo "<script>window.alert(".$_GET['vendas'].")</script>";
                            } else {
                              echo "<script>window.alert('N chegou nada');</script>";
                            }

                          $sql = "Select* from vendas where idVendas = ?";

                    

                          $stmt = $conn->prepare($sql);
                          if($stmt->execute()) {
                            
                            $result = $stmt->get_result();
                            while($row = $result->fetch_assoc()){
                                ?>
                                <div class="checkboxes">
                                  <div>
                                  <label for="caixa"><?php echo $row['idVendas'] ?></label>
                                  <input type="checkbox" id="caixa" name="caixa" value="<?php echo $row['idVendas'] ?>" checked />
             
                                  </div>
                                <div>
                                <?php
                            } 

                          }
                        ?>

                      </div>
                      </form>
                  </fieldset>

              <div class="buttons-div">
                  <button type="button" class="button" id="tx" name="tx" onclick="acao()">Enviar</button>
                  <button type="button" class="button" onclick="exibir_opcao()">Registrar</button>
                  <button type="button" onclick="voltar()" class="button">Voltar</button>
              </div>
          </fieldset>
        </form>
    </div>

     

</body>
    
 <script>  
    function exibir_opcao(){
      const valor=document.getElementById('vendas');
      const selecionado= valor.options[valor.selectedIndex];
      window.alert(selecionado.value);
    }  
     
   
 </script>

 
</html>