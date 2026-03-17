# Café D'Vovó - Sistema de Gestão (ERP)

Este repositório contém o código-fonte do sistema de gestão integrado (ERP) desenvolvido para o **Café D'Vovó**. O sistema é uma aplicação web focada na administração de pessoas, produtos, vendas, logística e relatórios financeiros/operacionais.

## 📋 Índice

- [Funcionalidades](#-funcionalidades)
- [Tecnologias Utilizadas](#-tecnologias-utilizadas)
- [Estrutura do Projeto](#-estrutura-do-projeto)
- [Pré-requisitos](#-pré-requisitos)
- [Instalação e Configuração](#-instalação-e-configuração)

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
- **Gestão de Dependências:**
  - [Composer](https://getcomposer.org/) (PHP)
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
```

## ⚙️ Pré-requisitos

Para correr este projeto localmente, necessita de ter instalado:

- Um servidor Web (ex: Apache ou Nginx)
- PHP (versão 7.4 ou superior recomendada)
- MySQL ou MariaDB
- Composer
- Node.js e NPM (Para gerir dependências de frontend)

## 🛠️ Instalação e Configuração

Siga os passos abaixo para configurar o ambiente de desenvolvimento:

1. **Clonar o repositório**
   ```bash
   git clone [https://github.com/seu-utilizador/rep0133cafedvovo.git](https://github.com/seu-utilizador/rep0133cafedvovo.git)
   cd rep0133cafedvovo
   ```

2. **Instalar as dependências do PHP**
   ```bash
   composer install
   ```

3. **Instalar as dependências de Frontend**
   ```bash
   npm install
   ```

4. **Configurar a Base de Dados**
   - Crie uma base de dados no seu servidor MySQL/MariaDB (ex: `cafedvovo_db`).
   - Importe o ficheiro `cafedvovo.sql` para a base de dados recém-criada.
   - Navegue até `serverside/config/dbConnection.php` e atualize as credenciais (host, utilizador, palavra-passe e nome da base de dados) de acordo com o seu ambiente local.

5. **Configurar o Servidor Web**
   - Aponte a raiz do seu servidor virtual (DocumentRoot) para a pasta onde o projeto foi clonado. Certifique-se de que os acessos estão configurados corretamente para a pasta `public/`.

6. **Aceder ao sistema**
   - Abra o navegador e aceda ao endereço local configurado (ex: `http://localhost/rep0133cafedvovo/public/`).
