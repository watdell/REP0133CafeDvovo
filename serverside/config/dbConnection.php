<?php

 // Função para ativar relatórios de erro e configurar a conexão com o banco de dados
 function dbConnection() {
    // Ativar relatórios de erro
    error_reporting(E_ALL);
    ini_set('display_errors', 0); // Desativa a exibição de erros no navegador (em produção, geralmente deve ser 0)

    // Configurações do banco de dados
    $host = 'localhost'; // Endereço do servidor
    $port = 3306;        // Porta do MySQL do XAMPP (verifique no painel de controle do XAMPP)
    $user = 'usuario';     // Nome de usuário do MySQL
    $password = '12345678'; // Senha do MySQL
    $database = 'cafedvovo'; // Nome do banco de dados
    
    // Criando a conexão com o banco de dados
    $conn = new mysqli($host, $user, $password, $database, $port);

    // Definindo a codificação UTF-8 para aceitar caracteres especiais
    $conn->set_charset("utf8");

    // Verificando se a conexão foi bem-sucedida
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Retornando a conexão para ser usada nas outras funções ou páginas
    return $conn;
}

?>