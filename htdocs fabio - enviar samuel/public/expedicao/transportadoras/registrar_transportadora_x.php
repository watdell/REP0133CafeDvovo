<?php
include ('../../config/dbConnection.php');

$conn = dbConnection();

if ($conn->connect_error) {
    echo 'Conexão falhou: ' . $conn->connect_error;
    exit();
}

if ($_POST) {
  
    $messages = [];
    
    $correio = $_POST['correio'];
    $endereco_cobranca = $_POST['endereco_cobranca']; 
    $numero_cobranca = $_POST['numero_cobranca']; 
    $cidade_cobranca = $_POST['cidade_cobranca']; 
    $bairro_cobranca = $_POST['bairro_cobranca']; 
    $nome_empresa = $_POST['nome_empresa'];  
    $cep_empresa = $_POST['cep_empresa'];
    $endereco_empresa = $_POST['endereco_empresa']; 
    $numero_empresa = $_POST['numero_empresa'];  
    $cidade_empresa = $_POST['cidade_empresa'];  
    $bairro_empresa = $_POST['bairro_empresa']; 
    $uf_empresa = $_POST['uf_empresa'];  
    $cnpj = $_POST['cnpj'];  
    
    
    $stmt_empresa = $conn->prepare("INSERT INTO empresa (nome_empresa, cnpj) VALUES (?, ?)");
    $stmt_empresa->bind_param("ss", $nome_empresa, $cnpj);
    $stmt_empresa->execute();
    $ultimo_id_empresa = $conn->insert_id;

    $stmt_endereco_empresa = $conn->prepare("INSERT INTO endereco_empresa (empresa_id, endereco, numero, cidade, bairro, uf, cep) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt_endereco_empresa->bind_param("issssss", $ultimo_id_empresa, $endereco_empresa, $numero_empresa, $cidade_empresa, $bairro_empresa, $uf_empresa, $cep_empresa);
    $stmt_endereco_empresa->execute();

    $stmt_endereco_cobranca = $conn->prepare("INSERT INTO endereco_cobranca (empresa_id, endereco, numero, cidade, bairro, uf) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_endereco_cobranca->bind_param("isssss", $ultimo_id_empresa, $endereco_cobranca, $numero_cobranca, $cidade_cobranca, $bairro_cobranca, $uf_cobranca);
    $stmt_endereco_cobranca->execute();

    $stmt_empresa->close();
    $stmt_endereco_empresa->close();
    $stmt_endereco_cobranca->close();

    echo '<p>Empresa registrada com sucesso!</p>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../../../public/cadastro-pessoas/cliente_pj.php"; // Substitua pelo URL desejado
            }, 2000);
          </script>';
} else {
    echo 'Nenhum dado recebido';
}

$conn->close();
?>
