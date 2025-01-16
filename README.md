# Cadastro de Produtos - Integração com Mercado Livre

Este projeto é um sistema em Laravel que permite o cadastro de produtos diretamente na API do Mercado Livre. O objetivo é automatizar o processo de cadastramento de produtos, realizando o envio de dados como nome, descrição, preço, quantidade, categoria e imagem para a plataforma Mercado Livre.

## Requisitos

Antes de rodar o projeto, certifique-se de que você tem os seguintes requisitos instalados em sua máquina:

- PHP >= 8.0
- Composer
- MySQL
- Node.js e npm (para compilação de assets)
- Laravel 9.x ou superior

## Instalação

1. Clone este repositório para sua máquina local:

   ```bash
   git clone https://github.com/seu-usuario/projeto-mercado-livre.git
   
2. Acesse o diretório do projeto:
   
       cd projeto-mercado-livre

3. Instale as dependências do PHP com o Composer:

       composer install

4. Instale as dependências do frontend com o npm:

       npm install

5. Configure o banco de dados no .env. O Laravel utiliza MySQL por padrão, então edite as seguintes variáveis ​​para apontar para o seu banco de dados:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=desafio_mercado_livre
        DB_USERNAME=root
        DB_PASSWORD=sua_senha

6. Execute as migrações do banco de dados para criar a tabela products:

       php artisan migrate

7. Gere a chave de aplicação do Laravel, caso ainda não tenha feito isso:

       php artisan key:generate

8. Por fim, inicie o servidor de desenvolvimento:

       php artisan serve
       O servidor estará rodando em http://localhost:8000.

# Configuração de Variáveis ​​de Ambiente para Integração com Mercado Livre

## Para integrar seu sistema com a API do Mercado Livre, é necessário configurar as variáveis ​​de ambiente no arquivo .env.

1. Obter o client_ideclient_secret :

     Crie uma conta ou faça login no Desenvolvedor do Mercado Livre.
  
     Crie um novo aplicativo e obtenha o client_ide client_secret.
  
2. Configuração das variáveis : Adicione as variáveis ​​de ambiente abaixo ao seu arquivo .env:

        MERCADO_LIVRE_CLIENT_ID=seu_client_id
        MERCADO_LIVRE_CLIENT_SECRET=seu_client_secret
        MERCADO_LIVRE_REDIRECT_URI=http://localhost:8000/callback
        MERCADO_LIVRE_ACCESS_TOKEN=seu_access_token

   MERCADO_LIVRE_CLIENT_ID : Seus client_idobtidos ao criar o aplicativo no Mercado Livre.
   
   MERCADO_LIVRE_CLIENT_SECRET : Seus client_secretobtidos ao criar o aplicativo no Mercado Livre.
   
   MERCADO_LIVRE_REDIRECT_URI : Uma URL para onde o Mercado Livre irá redirecionar após autorização. No exemplo, usamos http://localhost:8000/callbackpara desenvolvimento local.
   
   MERCADO_LIVRE_ACCESS_TOKEN : O token de acesso, que será obtido após a autorização.

# Como gerar o token de acesso (OAuth)

A autenticação na API do Mercado Livre é feita utilizando OAuth 2.0. Para gerar o token de acesso, siga os passos abaixo:

## Passo 1: Redirecionar para o Mercado Livre

Quando você acessa uma URL /callbackem seu aplicativo, o Mercado Livre solicitará que você autorize o acesso à sua conta. Ao tentar acessar essa URL, será necessário fornecer o código de autorização.

    http://localhost:8000/callback

Se a autorização for bem sucedida, o Mercado Livre redirecionará para uma URL que você configurou no .envcomo o parâmetro code, como por exemplo:

    http://localhost:8000/callback?code=seu_codigo_de_autorizacao

# Passo 2: Trocar o Código pelo Token de Acesso

Após o redirecionamento, o sistema fará automaticamente uma requisição para o Mercado Livre, trocando o código de autorização por um access_token .

O token de acesso será então armazenado e poderá ser utilizado para fazer chamadas subsequentes à API do Mercado Livre, como o cadastro de produtos.

# Passo 3: Atualização do Token

O token de acesso pode expirar após um período. Você deve garantir que o sistema faça a atualização do token, caso necessário, ou o atualize manualmente de acordo com as recomendações da API.

## Funcionalidades

Cadastro de Produtos : Um produto pode ser cadastrado com os seguintes dados: nome, descrição, preço, quantidade em estoque, categoria e imagem. O produto é enviado para o Mercado Livre via API e também é armazenado no banco de dados MySQL.

Listagem de Produtos : Uma lista de produtos cadastrados é exibida, com informações como nome, preço, quantidade e imagem.

Autenticação OAuth com Mercado Livre : O sistema faz a troca do código de autorização pelo access_token para autenticação com a API do Mercado Livre.

![Captura de tela 2025-01-16 132305](https://github.com/user-attachments/assets/d191366d-48e1-450d-9259-ef51ef7d14a3)

![Captura de tela 2025-01-16 132357](https://github.com/user-attachments/assets/cfe19ff2-0695-4141-9b86-ffb7de1e889a)

![WhatsApp Image 2025-01-16 at 13 28 28](https://github.com/user-attachments/assets/afb9d2f1-633b-4e33-ac2f-9b36f1e8fa39)

![WhatsApp Image 2025-01-16 at 13 28 28 (1)](https://github.com/user-attachments/assets/37163e21-7bf5-4ae3-8538-c4da1e28fb12)
