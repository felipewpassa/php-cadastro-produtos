Sistema para gerenciamento de estoque de produtos e categorias

Teste técnico para vaga de programador PHP na Astrus Digital

## Tecnologias
Para o desenvolvimento do sistema foi utilizado as tecnologias:
- [PHP 7.x](https://www.php.net/)
- [Bootstrap 5](https://getbootstrap.com/)
- [Jquery 3.6.0](https://jquery.com)
- [Datatable](https://datatables.net/)

## Instalação
- É necessário um servidor Apache, PHP e Mysql. Algumas opções são: xampp ou wamp.

- Próximo passo é clonar o repositório para o diretório do servidor, normalmente são: /htdocs ou /www.

- Também é necessário criar o banco de dados, as instruções sql estão disponíveis no diretório /db/estoqueMax.sql

- É necessário configurar as informações do banco de dados, para isso, basta abrir o arquivo app/config.php e configurar:

```sh
DB_HOST (endereço do servidor mysql)            default: localhost
DB_PORT (porta do servidor mysql)               default: 3305
DB_USER (usuário para acesso ao banco de dados) default: root
DB_PASS (senha do usuário)                      default: root
DB_NAME (nome do banco de dados)                default: dbcadastroprodutos
```

- Também pode ser necessário configurar o host da aplicação, pois o sistema depende desta variável para fazer o correto direcionamento entre as páginas. Acesse o arquivo app/config.php e edite a variável HOST. 

```sh
    HOST (endereço onde a aplicação deve rodar) default: http://localhost
```

- Por fim, só executar o servidor Apache e acessar no host especificado ou http://localhost
