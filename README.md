<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Como Rodar o aplicativo:

## 1 - Criar um banco de dados mysql com o nome ficticiobank collation utf8mb4_general_ci

## 2 - No terminal, executar os comandos:

## composer install

## php artisan migrate

## 3 - No arquivo .env, da pasta raiz, alterar a variável DB_DATABASE

## De: DB_DATABASE=laravel

## Para: DB_DATABASE=ficticiobank

## 4 - Testando a api:

## Rode o comando php artisan serve na pasta raiz, pelo terminal, para rodar a aplicação. Esse comando irá retornar a url para o teste local da aplicação. Exemplo: http://127.0.0.1:8000

## Com o link do ambiente local utilize os endpoints:

## POST: /api/conta/criarcontainicial para criar uma conta inicial com um saldo de 500. Exemplo: http://127.0.0.1:8000/api/conta/criarcontainicial

## POST: /api/conta/1 para visualizar a conta inicial criada

## O uso do endpoint acima com uma conta_id não existente, retornará o erro 400.

## POST: /api/conta com um Json definido para criar uma conta com um saldo específico. Exemplo: {"saldo":200}

## POST: /api/transacao com o Json: {"forma_pagamento":"D", "conta_id": "1234", "valor":10} para testar uma transação. Caso a conta_id 1234 ainda não exista, ela será criada com um saldo inicial de 100. As demais formas de pagamento propostas, C & P, também são válidas para teste.

## Caso, durante o teste do endpoint acima, não haja saldo suficiente na conta acionada pela transação, será retornado o erro 400.
