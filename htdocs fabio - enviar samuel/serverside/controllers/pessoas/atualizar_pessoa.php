<?php
include ('../../config/dbConnection.php');

$conn = dbConnection();


// Obtendo dados diretamente do POST
$pessoa_id = $_POST['id']; 
$nome = $_POST['nome'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$telefone = $_POST['telefone'];
$pais = $_POST['pais'];
$cep = $_POST['cep'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$logradouro = $_POST['rua'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$cpf = $_POST['cpf_rg'];
$nacionalidade = $_POST['nacionalidade'];
$atividade = $_POST['descricao'];
$cnpj = $_POST['cnpj'];
$passaporte = $_POST['passaporte'];
$matricula = $_POST['matricula'];
$profissao = $_POST['cargo'];
$salario = $_POST['salario'];
$nome_empresa = $_POST['nome_empresa'];
$cnpj_empresa = $_POST['documento'];

// Inicializando uma variável para acompanhar o status
$success = true;

// Atualizando a tabela pessoa
$update_pessoa = "
UPDATE pessoa
SET nome = '$nome',
    email = '$email',
    data_nascimento = '$data_nascimento'
WHERE pessoa_id = $pessoa_id;
";

try {
    $conn->query($update_pessoa); 
} catch (Exception $e) {
    $success = false;
    echo "Ocorreu um erro ao atualizar Pessoa: {$e->getMessage()}";
}

// Atualizando a tabela telefone
$update_telefone = "
UPDATE telefone
SET telefone = '$telefone'
WHERE pessoa_id = $pessoa_id;
";

try {
    $conn->query($update_telefone); 
} catch (Exception $e) {
    $success = false;
    echo "Ocorreu um erro ao atualizar Telefone: {$e->getMessage()}";
}

// Atualizando a tabela endereco
$update_endereco = "
UPDATE endereco
SET pais = '$pais',
    cep = '$cep',
    estado = '$estado',
    cidade = '$cidade',
    bairro = '$bairro',
    rua = '$logradouro',
    numero = '$numero',
    complemento = '$complemento'
WHERE pessoa_id = $pessoa_id;
";

try {
    $conn->query($update_endereco); 
} catch (Exception $e) {
    $success = false;
    echo "Ocorreu um erro ao atualizar Endereço: {$e->getMessage()}";
}

// Atualizando a tabela funcionario, p_juridica ou p_fisica dependendo do caso
if (!empty($profissao)) {  // Exemplo: se for um funcionário
    $update_funcionario = "
    UPDATE funcionario
    SET matricula = '$matricula',
        cargo = '$profissao',
        salario = $salario
    WHERE funcionario_id = $pessoa_id;
    ";
    try {
        $conn->query($update_funcionario); 
    } catch (Exception $e) {
        $success = false;
        echo "Ocorreu um erro ao atualizar funcionário: {$e->getMessage()}";
    }
} elseif (!empty($cnpj)) {  // Exemplo: se for uma pessoa jurídica
    $update_pjuridica = "
    UPDATE p_juridica
    SET cnpj = '$cnpj',
        descricao = '$atividade'
    WHERE pjuridica_id = $pessoa_id;
    ";
    try {
        $conn->query($update_pjuridica); 
    } catch (Exception $e) {
        $success = false;
        echo "Ocorreu um erro ao atualizar Pessoa jurídica: {$e->getMessage()}";
    }
} elseif (!empty($cpf)) {  // Exemplo: se for uma Pessoa Física
    $update_pfisica = "
    UPDATE p_fisica
    SET cpf_rg = '$cpf',
        passaporte = '$passaporte',
        nacionalidade = '$nacionalidade'
    WHERE pfisica_id = $pessoa_id;
    ";
    try {
        $conn->query($update_pfisica); 
    } catch (Exception $e) {
        $success = false;
        echo "Ocorreu um erro ao atualizar pessoa física: {$e->getMessage()}";
    }
} elseif (!empty($nome_empresa)) {  // Exemplo: se for um Fornecedor
    $update_fornecedor = "
    UPDATE fornecedor
    SET nome_empresa = '$nome_empresa',
        documento = '$cnpj_empresa'
    WHERE fornecedor_id = $pessoa_id;
    ";
    try {
        $conn->query($update_fornecedor); 
    } catch (Exception $e) {
        $success = false;
        echo "Ocorreu um erro ao atualizar Fornecedor: {$e->getMessage()}";
    }
}

// Verificando se todas as atualizações foram bem-sucedidas
if ($success) {
    echo "Usuário atualizado com sucesso!";
    echo '<script>
            setTimeout(function() {
                window.location.href = "../../../public/relatorios/pessoas/pessoas.php"; // Substitua pelo URL desejado
            }, 2000);
          </script>';
}
?>
