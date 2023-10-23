![Logo AI Solutions](http://aisolutions.tec.br/wp-content/uploads/sites/2/2019/04/logo.png)

# AI Solutions

## Teste para novos candidatos (PHP/Laravel)

### Introdução

Este teste utiliza PHP 8.1, Laravel 10 e um banco de dados SQLite simples.

1. Faça o clone desse repositório;
1. Execute o `composer install`;
1. Crie e ajuste o `.env` conforme necessário
1. Execute as migrations e os seeders;

### Primeira Tarefa:

Crítica das Migrations e Seeders: Aponte problemas, se houver, e solucione; Implemente melhorias;

Migrations:
O erro indica que há uma incompatibilidade entre a coluna referenciada na chave estrangeira e a coluna real na tabela referenciada. Mais especificamente, o erro está relacionado às colunas 'category_id' em 'documents' e 'id' em 'categories'. A mensagem de erro indica que essas colunas são incompatíveis.

Ao analisar o código, parece que é utilizado o tipo bigInteger para a coluna 'category_id' em 'documents'. No entanto, a coluna 'id' em 'categories' esta sem definição de tipo.

A solução para isso é garantir que os tipos de dados das colunas envolvidas na relação de chave estrangeira sejam os mesmos. Podemos definir a coluna 'category_id' em 'documents' como unsignedBigInteger para garantir que o tipo seja o mesmo.

Seeders:
Ajustado arquivo DatabaseSeeder para utilização do método call chamando a CategorySeeder.
Incluida data de criação parea controle.

### Segunda Tarefa:

Crie a estrutura completa de uma tela que permita adicionar a importação do arquivo `storage/data/2023-03-28.json`, para a tabela `documents`. onde cada registro representado neste arquivo seja adicionado a uma fila para importação.

Feito isso crie uma tela com um botão simples que dispara o processamento desta fila.

Utilize os padrões que preferir para as tarefas.

Boa sorte!
