<?php

    // Função para retornar a consulta com base no tipo
    function getQuery($queryType) {
        // Definindo as consultas em um array
        $queries = [

            //$sql = 'INSERT INTO destino (nome_lugar, CEP, Logradouro, Bairro, Cidade, Estado) VALUES (?,?,?,?,?,?)';



             'select_all_destinos' => "SELECT
                                         destino.id,
                                         destino.nome_lugar,
                                         destino.CEP,
                                         destino.Logradouro,
                                         destino.Bairro,
                                         destino.Cidade,
                                         destino.Estado
                                        FROM
                                         destino;

             
             
             
             ",



            'select_all_clientes' =>  "SELECT 
                                        pessoa.pessoa_id,
                                        pessoa.nome,
                                        pessoa.email,
                                        telefone.telefone,
                                        pessoa.data_nascimento,
                                        endereco.pais,
                                        endereco.cep,
                                        endereco.estado,
                                        endereco.cidade,
                                        endereco.bairro,
                                        endereco.rua,
                                        endereco.numero,
                                        endereco.complemento,
                                        pessoa.data_cadastro,
                                        -- Campos específicos para Pessoa Física
                                        p_fisica.cpf_rg,
                                        p_fisica.passaporte,
                                        p_fisica.nacionalidade,
                                        -- Campos específicos para Pessoa Jurídica
                                        p_juridica.cnpj,
                                        p_juridica.descricao
                                        FROM 
                                        pessoa
                                        -- Junção com a tabela de Pessoa Física (se existir)
                                        LEFT JOIN 
                                        p_fisica ON pessoa.pessoa_id = p_fisica.pfisica_id
                                        -- Junção com a tabela de Pessoa Jurídica (se existir)
                                        LEFT JOIN 
                                        p_juridica ON pessoa.pessoa_id = p_juridica.pjuridica_id
                                        -- Junção com a tabela de telefone
                                        JOIN 
                                        telefone ON pessoa.pessoa_id = telefone.pessoa_id
                                        -- Junção com a tabela de endereço
                                        JOIN 
                                        endereco ON pessoa.pessoa_id = endereco.pessoa_id;",

            'select_all_funcionarios' => "SELECT 
                                            pessoa.pessoa_id,
                                            pessoa.nome,
                                            pessoa.email,
                                            telefone.telefone,
                                            pessoa.data_nascimento,
                                            endereco.pais,
                                            endereco.cep,
                                            endereco.estado,
                                            endereco.cidade,
                                            endereco.bairro,
                                            endereco.rua,
                                            endereco.numero,
                                            endereco.complemento,
                                            funcionario.matricula,
                                            funcionario.cargo,
                                            funcionario.salario,
                                            pessoa.data_cadastro
                                        FROM 
                                            pessoa
                                        JOIN 
                                            funcionario ON pessoa.pessoa_id = funcionario.funcionario_id
                                        JOIN 
                                            telefone ON pessoa.pessoa_id = telefone.pessoa_id
                                        JOIN 
                                            endereco ON pessoa.pessoa_id = endereco.pessoa_id;",

            'select_all_clientes_pf' => "SELECT 
                                            pessoa.pessoa_id,
                                            pessoa.nome,
                                            pessoa.email,
                                            telefone.telefone,
                                            pessoa.data_nascimento,
                                            endereco.pais,
                                            endereco.cep,
                                            endereco.estado,
                                            endereco.cidade,
                                            endereco.bairro,
                                            endereco.rua,
                                            endereco.numero,
                                            endereco.complemento,
                                            pessoa.data_cadastro,
                                            p_fisica.cpf_rg,
                                            p_fisica.passaporte,
                                            p_fisica.nacionalidade
                                        FROM 
                                            pessoa
                                        JOIN 
                                            p_fisica ON pessoa.pessoa_id = p_fisica.pfisica_id
                                        JOIN 
                                            telefone ON pessoa.pessoa_id = telefone.pessoa_id
                                        JOIN 
                                            endereco ON pessoa.pessoa_id = endereco.pessoa_id;",

            'select_all_clientes_pj' => "SELECT 
                                            pessoa.pessoa_id,
                                            pessoa.nome,
                                            pessoa.email,
                                            telefone.telefone,
                                            pessoa.data_nascimento,
                                            endereco.pais,
                                            endereco.cep,
                                            endereco.estado,
                                            endereco.cidade,
                                            endereco.bairro,
                                            endereco.rua,
                                            endereco.numero,
                                            endereco.complemento,
                                            pessoa.data_cadastro,
                                            p_juridica.cnpj,
                                            p_juridica.descricao
                                        FROM 
                                            pessoa
                                        JOIN 
                                            p_juridica ON pessoa.pessoa_id = p_juridica.pjuridica_id
                                        JOIN 
                                            telefone ON pessoa.pessoa_id = telefone.pessoa_id
                                        JOIN 
                                            endereco ON pessoa.pessoa_id = endereco.pessoa_id;",

            'select_all_fornecedores' => "SELECT 
                                            pessoa.pessoa_id,
                                            pessoa.nome,
                                            pessoa.email,
                                            telefone.telefone,
                                            pessoa.data_nascimento,
                                            endereco.pais,
                                            endereco.cep,
                                            endereco.estado,
                                            endereco.cidade,
                                            endereco.bairro,
                                            endereco.rua,
                                            endereco.numero,
                                            endereco.complemento,
                                            pessoa.data_cadastro,
                                            fornecedor.nome_empresa,
                                            fornecedor.documento
                                        FROM 
                                            pessoa
                                        JOIN 
                                            fornecedor ON pessoa.pessoa_id = fornecedor.fornecedor_id
                                        JOIN 
                                            telefone ON pessoa.pessoa_id = telefone.pessoa_id
                                        JOIN 
                                            endereco ON pessoa.pessoa_id = endereco.pessoa_id;",

            'select_all_funcionarios_by_id' => "SELECT 
                                                    pessoa.pessoa_id,
                                                    pessoa.nome,
                                                    pessoa.email,
                                                    telefone.telefone,
                                                    pessoa.data_nascimento,
                                                    endereco.pais,
                                                    endereco.cep,
                                                    endereco.estado,
                                                    endereco.cidade,
                                                    endereco.bairro,
                                                    endereco.rua,
                                                    endereco.numero,
                                                    endereco.complemento,
                                                    funcionario.matricula,
                                                    funcionario.cargo,
                                                    funcionario.salario,
                                                    pessoa.data_cadastro
                                                FROM 
                                                    pessoa
                                                JOIN 
                                                    funcionario ON pessoa.pessoa_id = funcionario.funcionario_id
                                                JOIN 
                                                    telefone ON pessoa.pessoa_id = telefone.pessoa_id
                                                JOIN 
                                                    endereco ON pessoa.pessoa_id = endereco.pessoa_id
                                                WHERE pessoa.pessoa_id = ?;", 

            'select_all_clientes_pf_by_id' => "SELECT 
                                                    pessoa.pessoa_id,
                                                    pessoa.nome,
                                                    pessoa.email,
                                                    telefone.telefone,
                                                    pessoa.data_nascimento,
                                                    endereco.pais,
                                                    endereco.cep,
                                                    endereco.estado,
                                                    endereco.cidade,
                                                    endereco.bairro,
                                                    endereco.rua,
                                                    endereco.numero,
                                                    endereco.complemento,
                                                    pessoa.data_cadastro,
                                                    p_fisica.cpf_rg,
                                                    p_fisica.passaporte,
                                                    p_fisica.nacionalidade
                                                FROM 
                                                    pessoa
                                                JOIN 
                                                    p_fisica ON pessoa.pessoa_id = p_fisica.pfisica_id
                                                JOIN 
                                                    telefone ON pessoa.pessoa_id = telefone.pessoa_id
                                                JOIN 
                                                    endereco ON pessoa.pessoa_id = endereco.pessoa_id
                                                WHERE pessoa.pessoa_id = ?;",
                    
            'select_all_clientes_pj_by_id' => "SELECT 
                                                    pessoa.pessoa_id,
                                                    pessoa.nome,
                                                    pessoa.email,
                                                    telefone.telefone,
                                                    pessoa.data_nascimento,
                                                    endereco.pais,
                                                    endereco.cep,
                                                    endereco.estado,
                                                    endereco.cidade,
                                                    endereco.bairro,
                                                    endereco.rua,
                                                    endereco.numero,
                                                    endereco.complemento,
                                                    pessoa.data_cadastro,
                                                    p_juridica.cnpj,
                                                    p_juridica.descricao
                                                FROM 
                                                    pessoa
                                                JOIN 
                                                    p_juridica ON pessoa.pessoa_id = p_juridica.pjuridica_id
                                                JOIN 
                                                    telefone ON pessoa.pessoa_id = telefone.pessoa_id
                                                JOIN 
                                                    endereco ON pessoa.pessoa_id = endereco.pessoa_id
                                                WHERE pessoa.pessoa_id = ?;",

            'select_all_fornecedores_by_id' => "SELECT 
                                                    pessoa.pessoa_id,
                                                    pessoa.nome,
                                                    pessoa.email,
                                                    telefone.telefone,
                                                    pessoa.data_nascimento,
                                                    endereco.pais,
                                                    endereco.cep,
                                                    endereco.estado,
                                                    endereco.cidade,
                                                    endereco.bairro,
                                                    endereco.rua,
                                                    endereco.numero,
                                                    endereco.complemento,
                                                    pessoa.data_cadastro,
                                                    fornecedor.nome_empresa,
                                                    fornecedor.documento
                                                FROM 
                                                    pessoa
                                                JOIN 
                                                    fornecedor ON pessoa.pessoa_id = fornecedor.fornecedor_id
                                                JOIN 
                                                    telefone ON pessoa.pessoa_id = telefone.pessoa_id
                                                JOIN 
                                                    endereco ON pessoa.pessoa_id = endereco.pessoa_id
                                                    
                                                WHERE pessoa.pessoa_id = ?;",

            'check_user_type' =>  "SELECT 
                            pessoa.pessoa_id,
                            COALESCE(
                                CASE WHEN EXISTS (SELECT 1 FROM funcionario WHERE funcionario_id = pessoa.pessoa_id) THEN 'funcionario' END,
                                CASE WHEN EXISTS (SELECT 1 FROM fornecedor WHERE fornecedor_id = pessoa.pessoa_id) THEN 'fornecedor' END,
                                CASE WHEN EXISTS (SELECT 1 FROM p_juridica WHERE pjuridica_id = pessoa.pessoa_id) THEN 'p_juridica' END,
                                CASE WHEN EXISTS (SELECT 1 FROM p_fisica WHERE pfisica_id = pessoa.pessoa_id) THEN 'p_fisica' END,
                                'nao_especializado'
                            ) AS tipo_usuario
                            FROM 
                                pessoa
                            WHERE 
                                pessoa.pessoa_id = ?;"                         
        ];

        // Retorna a consulta específica com base no tipo fornecido
        if (array_key_exists($queryType, $queries)) {
            return $queries[$queryType];
        } else {
            return null;  // Caso o tipo da consulta não seja encontrado
        }
    }
    /* ---------------- PARA O INDEX.PHP ----------------*/
    // Função para definir o intervalo de tempo
    function DateMod($mod) {
        $vencDate = new DateTime();
        $vencDate->modify($mod);
        return $vencDate->format('Y-m-d H:i:s');
    };

    // Função para buscar o total das despesas
    function getTotalFromTable($conn, $table, $dateColumn, $mod) {
        $dateFilter = DateMod($mod);
        $sum = ($table == 'vendas') ? 'total' : 'valor';
        $sql = "SELECT $dateColumn, SUM($sum) AS total FROM $table WHERE $dateColumn > ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $dateFilter);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['total'];
    }

    // Função para buscar as entradas
    function getEntradas($conn, $mod) {
        return getTotalFromTable($conn, 'entradas', 'data', $mod);
    }

    // Função para buscar as despesas
    function getDespesas($conn, $mod) {
        return getTotalFromTable($conn, 'despesas', 'data', $mod);
    }

    // Função para buscar as vendas
    function getVendas($conn, $mod) {
        return getTotalFromTable($conn, 'vendas', 'data_venda', $mod);
    }

    // Função para buscar dados para os gráficos (diário ou mensal)
    function getGraphData($conn, $table, $mod) {
        $dateFilter = DateMod($mod);
        $groupBy = ($mod == '-30 day') ? 'DAY(data)' : 'MONTH(data)';
        $sql = "SELECT data, SUM(valor) AS valor_diario FROM $table WHERE data > ? GROUP BY $groupBy ORDER BY data ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $dateFilter);
        $stmt->execute();
        $result = $stmt->get_result();

        $dataPoints = [];
        while($row = $result->fetch_assoc()) {
            $dataPoints[] = [
                'y' => $row['valor_diario'] * ($table == 'entradas' ? 1 : -1),
                'label' => substr($row['data'], 0, ($mod == '-30 day') ? 10 : 7)
            ];
        }
        return $dataPoints;
}

?>