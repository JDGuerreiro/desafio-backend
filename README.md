## Tecnologias
<p>Laravel</p>
<p>Laravel Breeze</p> 
<p>MySQL</p>

## Escopo
<p>Ao se registrar, o usuário consegue:</p>
<p>- simular cotações de compra de moeda estrangeira, sempre partindo de BRL</p>
<p>- Se configurado o envio de email, receberá os detalhes da cotação no email cadastrado</p>
<p>- ver seu histórico de cotações realizadas</p>
<p>- configurar taxas de cobrança das formas de pagamento</p>
<p>- configurar taxas de cobrança da conversão</p>

<p>Detalhes do desafio:</p>
<p>https://github.com/Oliveira-Trust/desafio-desenvolvedor/blob/master/vaga.md</p>

## Install
<p>Executar: composer install</p>
<p>Copiar arquivo .env.example para .env</p>
<p>Configurar arquivo ".env":</p>
<p>	- URL </p>
<p>	- Conexão da base de dados</p>
<p>	- Envio de email</p>
<p>Criar base de dados</p>
<p>Executar: php artisan migrate</p>
<p>Executar: php artisan key:generate</p>

## Melhorias
<p>Usar Observers e filas para envio dos emails de criação de novas cotações</p>
<p>Usar repositories para tirar complexidade dos controllers e padronizar chamadas</p>
<p>Testes automatizados</p>
