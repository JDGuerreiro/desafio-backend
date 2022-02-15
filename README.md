## Tecnologias
Laravel
Laravel Breeze 
MySQL

## Escopo
Ao se registrar, o usuário consegue:
- simular cotações de compra de moeda estrangeira, sempre partindo de BRL
- Se configurado o envio de email, receberá os detalhes da cotação no email cadastrado
- ver seu histórico de cotações realizadas
- configurar taxas de cobrança das formas de pagamento
- configurar taxas de cobrança da conversão

Detalhes do desafio:
https://github.com/Oliveira-Trust/desafio-desenvolvedor/blob/master/vaga.md

## Install
Executar: composer install
Copiar arquivo .env.example para .env
Configurar arquivo ".env":
	- URL 
	- Conexão da base de dados
	- Envio de email
Criar base de dados
Executar: php artisan migrate
Executar: php artisan key:generate
