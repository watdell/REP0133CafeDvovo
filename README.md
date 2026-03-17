# Café D'Vovó - Sistema de Gestão (ERP)

Este repositório contém o código-fonte do sistema de gestão integrado (ERP) desenvolvido para o **Café D'Vovó**. O sistema é uma aplicação web focada na administração de pessoas, produtos, vendas, logística e relatórios financeiros/operacionais.

## 📋 Índice

- [Funcionalidades](#-funcionalidades)
- [Tecnologias Utilizadas](#-tecnologias-utilizadas)
- [Estrutura do Projeto](#-estrutura-do-projeto)
- [Pré-requisitos](#-pré-requisitos)
- [Instalação e Configuração](#-instalação-e-configuração)
- [Autores](#-autores)

## 🚀 Funcionalidades

O sistema está dividido em vários módulos independentes para facilitar a gestão do negócio:

- **👥 Cadastro de Pessoas:**
  - Clientes (Pessoas Físicas e Jurídicas)
  - Fornecedores
  - Funcionários
- **📦 Cadastro de Produtos e Insumos:**
  - Gestão de stock e inventário
  - Registo de insumos necessários para a produção
- **💼 Módulo Comercial:**
  - Ponto de Venda (PDV) e registo de vendas
  - Controlo de Caixa (Abertura, fecho, entradas e despesas)
  - Gestão de Orçamentos e Pagamentos
  - Cálculo de Fretes e Pós-venda
- **🚚 Expedição e Logística:**
  - Controlo de destinos e rotas de entrega
  - Integração com transportadoras (ex: Correios)
- **📊 Relatórios:**
  - Geração de relatórios de vendas, stock, produtos e pessoas
  - Exportação e importação de dados via Excel (utilizando a biblioteca PhpSpreadsheet)
  - Gráficos de análise e dashboards (utilizando Chart.js)

## 💻 Tecnologias Utilizadas

- **Backend:** PHP
- **Base de Dados:** MySQL / MariaDB (Ficheiro `.sql` incluído)
- **Frontend:** HTML5, CSS3, JavaScript (Vanilla)
- **Gestão de Dependências:** - [Composer](https://getcomposer.org/) (PHP)
  - [NPM](https://www.npmjs.com/) (JavaScript)
- **Bibliotecas Principais:**
  - `phpoffice/phpspreadsheet` (Manipulação de folhas de cálculo Excel/CSV)
  - `chart.js` (Renderização de gráficos)
  - `ezyang/htmlpurifier` (Prevenção de XSS e limpeza de HTML)

## 📁 Estrutura do Projeto

A arquitetura do projeto segue uma divisão lógica entre os ficheiros expostos ao cliente e a lógica de servidor:

```text
├── public/                 # Ficheiros expostos ao servidor web (Páginas, CSS, JS, Imagens)
│   ├── assets/             # Estilos (CSS), Scripts (JS) e Imagens estáticas
│   ├── cadastro-pessoas/   # Interfaces de registo de entidades
│   ├── cadastro-produtos/  # Interfaces de registo de produtos
│   ├── comercial/          # Interfaces de vendas, caixa, orçamentos e despesas
│   ├── expedicao/          # Interfaces de logística e transporte
│   ├── insumos/            # Interfaces de gestão de matérias-primas
│   ├── relatorios/         # Ecrãs de relatórios e exportação
│   └── servicos/           # Interfaces de gestão de serviços e contratos
├── serverside/             # Lógica de negócio e base de dados (Não exposto diretamente)
│   ├── config/             # Ficheiros de configuração (ex: dbConnection.php)
│   ├── controllers/        # Controladores (Processamento de formulários e regras de negócio)
│   └── queries/            # Ficheiros com as consultas (SQL) à base de dados
├── cafedvovo.sql           # Ficheiro de exportação da base de dados inicial
├── composer.json           # Dependências do backend (PHP)
├── package.json            # Dependências do frontend (JS)
└── README.md               # Documentação do projeto
