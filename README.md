## Processo seletivo para desenvolvedor PHP


Para este teste precisamos avaliar o seu conhecimento em PHP utilizando a plataforma Laravel, e para isso temos alguns requisitos mínimos:

- Entregar o Crud funcionando.
- Utilizar o Framework Laravel com o template [Argon](https://www.creative-tim.com/product/argon-dashboard-laravel).
- Utilizar a componetização do blade para criar as telas.
- Utilizar as migrations do Laravel para configurar o banco.
- O projeto deverá ser entregue pelo github.
- Utilizar as rotas para os padrões de login, logout e controle de acesso.

De acordo com isso segue em anexo as imagens do caso de uso que deve ser desenvolvido.

### Observações: 

- Apesar do wireframe mostrar a separação em abas, não deve ser feita dessa forma, utilizar outro modelo, mas separando elas em blocos.
- Tratar como apenas uma tela.
- Essa tela só pode ser acessadas com usuário e senha.

### Execução:

Instalar dependências
```
composer install
````

Copiar arquivo .env.example para .env (na raiz do projeto)

Configurar APP_KEY e conexão com DB no arquivo .env

Executar migrations com seed:
```
php artisan migrate --seed
```
Autenticar com as credenciais:

- usuário: admin@argon.com
- senha: secret
