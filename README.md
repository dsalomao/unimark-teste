<p align="center"><a href="https://laravel.com" target="_blank"><img width="800" height="328" src="https://universidademarketplaces.com.br/wp-content/uploads/2021/03/logo-ok_curvas-1024x420.png" class="attachment-large size-large" alt="" loading="lazy" srcset="https://universidademarketplaces.com.br/wp-content/uploads/2021/03/logo-ok_curvas-1024x420.png 1024w, https://universidademarketplaces.com.br/wp-content/uploads/2021/03/logo-ok_curvas-300x123.png 300w, https://universidademarketplaces.com.br/wp-content/uploads/2021/03/logo-ok_curvas-768x315.png 768w, https://universidademarketplaces.com.br/wp-content/uploads/2021/03/logo-ok_curvas.png 1346w" sizes="(max-width: 800px) 100vw, 800px"></a></p>

<p align="center">
</p>

## Sobre

Este era um desafio de criar um CRUD de programadores e importaão dos mesmos através da API do Github.

## Requisitos

### Importação de Programadores
Consumir a API pública do Github para trazer 300 programadores com os seguintes requisitos (Utilizar Command + Job):

- **Conhecimento em PHP e Laravel**
- **Localizado no Brasil**
- **Possuir mais de 1 repositório público**
- **Possuir mais de 9 estrelas em qualquer um de seus repositórios**

### Armazenamento
Estes programadores deverão ser armazenados em uma base de dados MySQL ou Maria DB de forma estruturada e normalizada para que seja fácil o consumo dessas informações posteriormente.

### CRUD Programadores

- **Listagem paginada de programadores (10 por página)**
- **Adicionar programador manualmente**
- **Editar programador existente**
- **Excluir programador de forma segura**
- **Pesquisar programador por nome**
- **Visualizar um programador específico (Perfil do Programador)**

### Autenticação
Não podemos deixar essa Área Administrativa exposta para o mundo, então você vai precisar que ela tenha rotas protegidas por usuários autenticados e gestão de usuários que
poderão acessar essa área.

## Execução e Observações

- **Todos os requisitos foram executados.**

### CRUD
- **O CRUD de programadores pode ser acessado criando um usuário na tela Wealcome e fazendo login na ferramenta.**
- **No CRUD é possível criar, ler, editar, deletar(logicamente), remover(permanentemente) e buscar por nome qualquer programador.**

### COMMAND
- **Foi Criado um comando do artisan chamado "custom:gitusers que comunica com a API do Github e traz 300 programadores com os requisitos solicitados. Esses requisitos nesta versão não podem ser passados como parâmetros para o comando."**
- **As requisições feitas peo comando são salvas na base de dados para administração da paginação e garantia de importação de todas as páginas de programadores do Github para aqueles parâmetros.**
- **Ao final da execução o comando também joga um JOB na fila com esses 300 programadores.**
- **PARA RODAR O COMANDO: sail artisan custom:gitusers**

- **IMPORTANTE: Algumas requisições da API do Github necessitam autenticação. Então colocar sua OATH Token no arquivo .env. GITHUB_OATH_T="MINHA OATH TOKEN"**

### JOB
- **Foi criado um JOB para cadastrar no BD de forma assincrona os programadores requisitados pelo comando.**

### SCHEDULER
- **Foi criado um agendador que executa o comando a cada 5 minutos. Para não ter de inicializar outro worker manualmente, foi programada a execução de um QUEUE WORKER ao final da execução do comando no Scheduler**
- **PARA RODAR O SCHEDULER: sail artisan schedule:work**


