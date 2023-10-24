### Introdução

1. Faça o clone desse repositório;
2. Execute o `composer install`;
3. Crie e ajuste o `.env` conforme necessário
4. Execute as migrations e os seeders com o seguinte comando: `php artisan migrate --seed`
5. Execute o comando para iniciar o servidor de desenvolvimento local. `php artisan serve`
6. Acesse o aplicativo pelo navegador em `http://localhost:8000`.
7. Utilize a tela inicial para adicionar a importação do arquivo storage/data/2023-03-28.json ou do que mais desejar, desde que no mesmo formato.
8. Pressione o botão `import` para importar o arquivo desejado.
9. Abra em seu navegador a url `http://localhost:8000/process-queue`, la estarão listados os arquivos importados para executar a fila .10. Clique em `Processar fila` para iniciar o processamento da fila.

### Primeira Tarefa:

## Crítica das Migrations e Seeders:

## Migrations:
O erro indica que há uma incompatibilidade entre a coluna referenciada na chave estrangeira e a coluna real na tabela referenciada. Mais especificamente, o erro está relacionado às colunas 'category_id' em 'documents' e 'id' em 'categories'. A mensagem de erro indica que essas colunas são incompatíveis.

Ao analisar o código, parece que é utilizado o tipo bigInteger para a coluna 'category_id' em 'documents'. No entanto, a coluna 'id' em 'categories' esta sem definição de tipo.

A solução para isso é garantir que os tipos de dados das colunas envolvidas na relação de chave estrangeira sejam os mesmos. Podemos definir a coluna 'category_id' em 'documents' como unsignedBigInteger para garantir que o tipo seja o mesmo.

## Seeders:
Ajustado arquivo DatabaseSeeder para utilização do método call chamando a CategorySeeder.
Incluida data de criação parea controle.

### Segunda Tarefa:

Crie a estrutura completa de uma tela que permita adicionar a importação do arquivo `storage/data/2023-03-28.json`, para a tabela `documents`. onde cada registro representado neste arquivo seja adicionado a uma fila para importação.

Feito isso crie uma tela com um botão simples que dispara o processamento desta fila.
