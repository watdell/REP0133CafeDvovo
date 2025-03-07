<?php 

/*
    Este script é responsável por processar um formulário que insere um novo produto em um banco de dados.
    Ele captura informações do produto e insumos associados, insere os dados do produto na tabela 'produto',
    e em seguida insere os insumos relacionados na tabela 'produto_insumo' e atualiza o estoque na tabela 'insumo'.

    O fluxo do script é o seguinte:
    1. Conecta ao banco de dados.
    2. Verifica se a requisição é do tipo POST.
    3. Captura dados do formulário, incluindo detalhes do produto e insumos.
    4. Insere os dados do produto na tabela 'produto'.
    5. Para cada insumo, insere na tabela 'produto_insumo' e atualiza o estoque na tabela 'insumo'.
    6. Exibe mensagens de erro se algo falhar.

    Exemplo de uso: Se um usuário preencher um formulário com dados como nome do produto, descrição, tipo de venda, etc.,
    e incluir insumos com suas quantidades, ao enviar o formulário, este script irá processar e armazenar esses dados no banco de dados.
*/

// Habilita a exibição de erros para facilitar a depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// importando conexão com o banco de dados
include ('../../config/dbConnection.php');

$conn = dbConnection();

// Certificando-se de que a conexão foi bem-sucedida 
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error); // Use die para encerrar em caso de erro
}

// Certificando-se de que o método é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os valores do formulário
    $nome_produto = $_POST['nome-produto'] ?? '';
    $descricao_produto = $_POST['descricao-produto'] ?? '';
    $tipo_venda = $_POST['tipo-venda'] ?? '';
    $peso_total = $_POST['peso-total'] ?? '';
    // Captura os insumos e suas quantidades
    /*$insumos = json_encode($_POST['insumo']) ?? [];
    $quantidades = json_encode($_POST['qntd-insumo']) ?? [];
    $estoque_atual_insumo = json_encode($_POST['qntd-insumo-lista']) ?? [];*/

    $insumos = $_POST['insumo'];
    $quantidades = $_POST['qntd-insumo'];
    $estoque_atual_insumo = $_POST['qntd-insumo-lista'];

    $menor_data = $_POST['menor-data'] ?? '';
    $custo_total_unidade = $_POST['custo-total-unidade'] ?? '';
    $margem_lucro = $_POST['margem-lucro'] ?? '';
    $preco_venda = $_POST['preco-venda'] ?? '';
    $quantidade_para_estoque = $_POST['quantidade-para-estoque'] ?? '';
    $estoque_minimo = $_POST['estoque-minimo'];
    $data_cadastro = date('Y/m/d');

    $imageData = '';
    $imageType = '';

    $image = $_FILES['imagem-produto']['tmp_name'] ?? '';
    
        if ($image) {
            $imageData = file_get_contents($image);
            $imageType = $_FILES['imagem-produto']['type'];
        }
    
    // Usado para debug..
    //echo "Imagem recebida: ";
    //var_dump($imageData); // Exibe o conteúdo da imagem ou indica se está vazio
    //echo "Tipo da imagem: " . htmlspecialchars($imageType);

    // Exibe valores recebidos para debug
    //foreach ($_POST as $key => $value) {
    //   echo "Key: " . htmlspecialchars($key) . ", Value: " . (is_array($value) ? json_encode($value) : htmlspecialchars($value)) . "<br>";
    //}

    //$estoque_atual_insumo = json_decode($_POST['qntd-insumo-lista'], true) ?? [];
    
    // Atenção que para poder adicionar imagens muito grandes você vai ter que mudar um parâmetro de configuração no mysql, caso contrário vai encontrar erro,
    // Caso tente add certas imagens..
    // Abra o arquivo my.cnf ou my.ini e adicione ou edite a seguinte linha na seção [mysqld]:
    // [mysqld]
    // max_allowed_packet = 16M
    // Edite para 32M ou 64M
    // depois para fins de consulta vc usa essa consulta sql no phpmyadmin msm pra ver o novo tamanho: SHOW VARIABLES LIKE 'max_allowed_packet';
    
    $stmt = $conn->prepare("INSERT INTO produto (imagem, tipo_imagem, nome, descricao, tipo, peso, custo, margem_lucro, preco_venda, estoque_atual, estoque_minimo, data_validade, data_cadastro) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
    if ($stmt) {
        // Vincula os parâmetros: imagem, tipo_imagem e os demais campos
        $stmt->bind_param("sssssddddiiss", $imageData, $imageType, $nome_produto, $descricao_produto, $tipo_venda, $peso_total, $custo_total_unidade, $margem_lucro, $preco_venda, $quantidade_para_estoque, $estoque_minimo, $menor_data, $data_cadastro);
    
        // Executa a declaração
        if (!$stmt->execute()) {
            echo "Erro ao executar a declaração SQL: " . $stmt->error;
        }

    } else {
        echo "Erro ao preparar a declaração SQL: " . $conn->error;
    }

    // Pega o último ID inserido na tabela 'produto'
    $ultimo_id = $conn->insert_id;

    // Prepara a instrução SQL para atualizar o estoque dos insumos
    $stmt_update = $conn->prepare("UPDATE insumo SET estoque_atual = ? WHERE insumo_id = ?");
    if (!$stmt_update) {
        die("Erro ao preparar a declaração de atualização: " . $conn->error);
    }

    // Verifica se os arrays de insumos e quantidades têm o mesmo tamanho
    if (count($insumos) === count($quantidades)) {
        for ($i = 0; $i < count($insumos); $i++) {
            $stmt_select = $conn->prepare("SELECT * FROM insumo WHERE insumo_id = ?");
            $stmt_select->bind_param("i", $insumos[$i]);
            $stmt_select->execute();
            $result = $stmt_select->get_result();
            $row = $result->fetch_assoc();

            // Insere os insumos
            $stmt_insumo = $conn->prepare("INSERT INTO produto_insumo (produto_id, insumo_id, qntd_insumo) VALUES (?,?,?)");
            if (!$stmt_insumo) {
                die("Erro ao preparar a declaração de inserção de insumo: " . $conn->error);
            }
            
            $quantidade = floatval($quantidades[$i]); // Convertendo a quantidade para float
            $stmt_insumo->bind_param("iid", $ultimo_id, $insumos[$i], $quantidade);
            if (!$stmt_insumo->execute()) {
                die("Erro ao executar a inserção de insumo: " . $stmt_insumo->error);
            }

            // Atualiza o estoque do insumo
            $novo_estoque_insumo = floatval($row['estoque_atual']) - ( $quantidade * floatval($quantidade_para_estoque) );
            $stmt_update->bind_param("di", $novo_estoque_insumo, $insumos[$i]);
            if (!$stmt_update->execute()) {
                die("Erro ao atualizar o estoque do insumo: " . $stmt_update->error);
            }
        }

        // Mensagem de sucesso e redirecionamento
        echo "<h2>Produto cadastrado com sucesso!</h2>";
        echo "<p>Você será redirecionado em 2 segundos...</p>";
        echo '<meta http-equiv="refresh" content="2;url=\'../../../public/relatorios/produtos/produtos.php\'">';

        $stmt->close();
        $stmt_update->close();
        $conn->close();
    } else {
        echo "O número de insumos e quantidades não coincide.";
    }

    // Exibe valores recebidos para debug
    //foreach ($_POST as $key => $value) {
    //    echo "Key: " . htmlspecialchars($key) . ", Value: " . (is_array($value) ? json_encode($value) : htmlspecialchars($value)) . "<br>";
    //}
} else {
    echo "Método de requisição inválido.";
} 
?>
