### Introdução

1. Faça o clone desse repositório;
2. Execute o `composer install`;
3. Tenha iointalado na máquina o `PHP`, o `Laravel`, o `Composer` e o `MySql`;
4. Caso não tenha seguem urls:
    `https://kinsta.com/pt/base-de-conhecimento/mysql-community-server/#:~:text=Voc%C3%AA%20deve%20ver%20dois%20arquivos,depois%20instalar%20o%20MySQL%20manualmente.`, 
    `https://suporte.hostgator.com.br/hc/pt-br/articles/115004145214-Como-instalar-o-Laravel-`, 
    `https://www.php.net/downloads`, `https://www.hostinger.com.br/tutoriais/como-instalar-e-usar-o-composer`;
4. Crie e ajuste o `.env` conforme necessário
5. crie a tabela de banco de dados no MySQL com o nome `laravel`.
6. Execute as migrations e os seeders com o seguinte comando: `php artisan migrate --seed`
7. Execute o comando para iniciar o servidor de desenvolvimento local. `php artisan serve`
8. Acesse o aplicativo pelo navegador em `http://localhost:8000`.
9. Utilize a tela inicial para adicionar a importação do arquivo storage/data/2023-03-28.json ou do que mais desejar, desde que no mesmo formato.
10. Pressione o botão `import` para importar o arquivo desejado.
11. Abra em seu navegador a url `http://localhost:8000/process-queue`, la estarão listados os arquivos importados para executar a fila .12. Clique em `Processar fila` para iniciar o processamento da fila.
13. Execute o teste para verificar o funcionamento do serviço, execute: `php artisan test` no terminal e veja qual a saída

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
