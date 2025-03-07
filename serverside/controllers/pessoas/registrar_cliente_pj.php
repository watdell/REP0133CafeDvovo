<?php
include ('../../config/dbConnection.php');

$conn = dbConnection();

// Verificando a conexão
if ($conn->connect_error) {
    echo 'Conexão falhou: ' . $conn->connect_error;
    exit();
}

// Verificar se os dados foram recebidos
if ($_POST) {
    // Mensagens para mostrar na página
    $messages = [];

    // Transformar as chaves do array em variáveis
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['nascimento'];
    $data_cadastro = date('Y-m-d'); 
    $pais = $_POST['pais'];
    $cep = $_POST['cep'];
    $uf = $_POST['estado']; 
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua_av = $_POST['rua']; 
    $numero = $_POST['numero']; 
    $complemento = $_POST['complemento']; 
    $telefone = $_POST['telefone'];
    $cnpj_pjuridica = $_POST['cnpj_pjuridica'];
    $atividade = $_POST['atividade']; 


    // Preparar a consulta SQL para inserção na tabela pessoa
    $stmt = $conn->prepare("INSERT INTO pessoa (nome, email, data_nascimento, data_cadastro) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $data_nascimento, $data_cadastro);
    $stmt->execute();
    $ultimo_id = $conn->insert_id;

    // Inserção na tabela endereco
    $stmt_endereco = $conn->prepare("INSERT INTO endereco (pessoa_id, pais, cep, estado, cidade, bairro, rua, numero, complemento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
    $stmt_endereco->bind_param("issssssss", $ultimo_id, $pais, $cep, $uf, $cidade, $bairro, $rua_av, $numero, $complemento);
    $stmt_endereco->execute();

    // Inserção na tabela telefone
    $tipo = 'principal';
    $stmt_telefone = $conn->prepare("INSERT INTO telefone (pessoa_id, telefone, tipo) VALUES (?, ?, ?);");
    $stmt_telefone->bind_param("iss", $ultimo_id, $telefone, $tipo);
    $stmt_telefone->execute();

    // Inserção na tabela de Pessoa Jurídica
    $stmt_clientePF = $conn->prepare("INSERT INTO p_juridica (pjuridica_id, cnpj, descricao) VALUES (?, ?, ?);");
    $stmt_clientePF->bind_param("iss", $ultimo_id, $cnpj_pjuridica, $atividade);
    $stmt_clientePF->execute();
    

    // Fechar as declarações
    $stmt->close();
    $stmt_endereco->close();
    $stmt_telefone->close();
    if (isset($stmt_clientePF)) {
        $stmt_clientePF->close();
    }

    // Exibir mensagem de sucesso e redirecionar
    echo '<p>Usuário registrado com sucesso!</p>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../../../public/cadastro-pessoas/cliente_pj.php"; // Substitua pelo URL desejado
            }, 2000);
          </script>';
} else {
    echo 'Nenhum dado recebido';
}

// Fechar a conexão
$conn->close();
?>
