
# Elec-shop documentation API

## Tabela de Conteúdos

1. [Sobre](#sobre)
2. [Instalação](#install)
3. [Documentação](#doc)
4. [Desenvolvedor](#devs)
6. [Termos de uso](#terms)


---

<a name="sobre"></a>

## 1. Sobre

- API Laravel com CRUD de eletrodomésticos, permitindo gerenciar dados como nome, descrição, marca, voltagem e quantidade.



---
<a name="install"></a>

## 2. Instalação e uso

### 2.1 Requisitos:
- PHP a partir da versão 5.5.9
- Composer gerenciador de dependências para PHP
- Banco de dados MySQL

### 2.2 Instalação
2.2.1 - Crie um banco de dados chamado technical_db no MySQL

2.2.2 - Após o clone no repositório para adicionar todas as dependências do composer json execute o comando: 
`composer install` 

2.2.3 - Crie um arquivo na raiz do projeto chamado .env e faça as configurações das variáveis de ambiente com base no .env.example do projeto
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=technical_db
DB_USERNAME={Usuario do db}
DB_PASSWORD={Senha do db}
```

2.2.4 - Apos criar o arquivo .env e adicionar as informações do banco de dados rode o comando `php artisan migrate` se tudo estiver correto é para retonar
```
INFO  Preparing database.

Creating migration table ....................................................... 561ms DONE

INFO  Running migrations.

2014_10_12_000000_create_users_table ........................................... 146ms DONE
2014_10_12_100000_create_password_reset_tokens_table ........................... 465ms DONE
2019_08_19_000000_create_failed_jobs_table ..................................... 387ms DONE
2019_12_14_000001_create_personal_access_tokens_table .......................... 626ms DONE
2023_07_14_011944_create_appliances_table ...................................... 370ms DONE
```

2.2.5 - Para popular o banco de dado utilize o comando `php artisan db:seed --class=AppliancesTableSeeder` no terminal, caso de tudo certo receberá uma mensagem parecida com essa:

```
INFO  Seeding database.
```

2.2.6 - Para rodar projeto utilize o comando `php artisan serve` no terminal, caso de tudo certo receberá uma mensagem parecida com essa:

```
INFO  Server running on [http://127.0.0.1:8000].
Press Ctrl+C to stop the server
```

<a name="doc"></a>

## 3. Documentação
3.1 Informação nenhuma rota tem authenticação.

3.2 Rota para pegar todos os eletrodomésticos `metodo:get Rota:localhost:8000/api/appliances` 

retorno:

`status: 200`
```
[
	{
		"id": 1,
		"name": "hewlito",
		"image": null,
		"quantity": 0,
		"description": "Chat é um descrição",
		"marking": "lg",
		"voltage": "127",
		"created_at": "2023-07-15T18:17:57.000000Z",
		"updated_at": "2023-07-15T18:18:46.000000Z"
	},
	{
		"id": 2,
		"name": "fugit",
		"image": "https:\/\/www.realce.ind.br\/extranet\/thumbnail.png",
		"quantity": 12,
		"description": "Nobis rerum libero rerum iusto.",
		"marking": "samsung",
		"voltage": "110",
		"created_at": "2023-07-15T18:32:27.000000Z",
		"updated_at": "2023-07-15T18:32:27.000000Z"
	}
]
```

3.3 Rota para pegar o eletrodomésticos pelo id  `metodo:get Rota:localhost:8000/api/appliances/{id}` 

  retorno:

  3.3.1 Retorno caso o id exista:
  
  `status: 200`
  ```
  {
  	"id": 2,
  	"name": "hewlito",
  	"image": null,
  	"quantity": 0,
  	"description": "Chat é um descrição",
  	"marking": "lg",
  	"voltage": "127",
  	"created_at": "2023-07-15T18:17:57.000000Z",
  	"updated_at": "2023-07-15T18:18:46.000000Z"
  }
  ```
  3.3.2 Retorno caso o id não exista:
  
  `status: 404 `
  ```
  {
	  "message": "appliance not found!"
  }
  ```

3.4 Rota para pegar todos os eletrodomésticos de uma marca específica  `metodo:get Rota:localhost:8000/api/appliances/marking/{marca}` 

retorno:

`status: 200`
```
[
	{
		"id": 2,
		"name": "maxime",
		"image": "https:\/\/www.realce.ind.br\/extranet\/thumbnail.png",
		"quantity": 1,
		"description": "Non qui neque perspiciatis.",
		"marking": "lg",
		"voltage": "220",
		"created_at": "2023-07-16T03:45:53.000000Z",
		"updated_at": "2023-07-16T03:45:53.000000Z"
	},
	{
		"id": 4,
		"name": "totam",
		"image": null,
		"quantity": 2,
		"description": "Accusamus quaerat a totam nihil qui qui.",
		"marking": "lg",
		"voltage": "127",
		"created_at": "2023-07-16T03:45:53.000000Z",
		"updated_at": "2023-07-16T03:45:53.000000Z"
	}
]
```

3.5 Rota para pesquisar o eletrodomésticos pelo nome  `metodo:get Rota:localhost:8000/api/appliances/search/{search}` 

retorno:

`status: 200`
```
[
	{
		"id": 3,
		"name": "corporis",
		"image": "https:\/\/www.realce.ind.br\/extranet\/thumbnail.png",
		"quantity": 7,
		"description": "Sit aliquam qui excepturi assumenda maiores et neque.",
		"marking": "electrolux",
		"voltage": "110",
		"created_at": "2023-07-16T03:45:53.000000Z",
		"updated_at": "2023-07-16T03:45:53.000000Z"
	},
	{
		"id": 4,
		"name": "corpos",
		"image": null,
		"quantity": 2,
		"description": "Accusamus quaerat a totam nihil qui qui.",
		"marking": "lg",
		"voltage": "127",
		"created_at": "2023-07-16T03:45:53.000000Z",
		"updated_at": "2023-07-16T03:45:53.000000Z"
	}
]
```

3.6 Rota para pegar o eletrodomésticos pelo marca  `metodo:get Rota:localhost:8000/api/appliances/marking/lg` 

retorno:

`status: 200`
```
{
	"id": 2,
	"name": "hewlito",
	"image": null,
	"quantity": 0,
	"description": "Chat é um descrição",
	"marking": "lg",
	"voltage": "127",
	"created_at": "2023-07-15T18:17:57.000000Z",
	"updated_at": "2023-07-15T18:18:46.000000Z"
}
```

3.7 Rota para cadastrar o eletrodomésticos  `metodo:post Rota:localhost:8000/api/appliances`:
  
    Campos obrigatorios no body da requisição:
    name: "Geladeira"
    description: "é um descrição"
    marking: "LG" **é um option que aceita somente essas marcas ['electrolux', 'brastemp', 'fischer', 'samsung', 'lg']**
    voltage: "220" **é um option que aceita somente essas voltagems ['110', '220']**

    Campos opicionais no body da requisição:
    image: **Link da imagem**
    quatity: 10 **Quantidade de produtos**

    Exemplo de body:
    ```
    {
      "name": "Geladeira",
      "description": "é uma descrição",
      "marking": "lg",
      "voltage": "220",
      "quantity": 34
    }
    ```
  `

  3.7.1 Caso o esteja com todos os dados correto

    `status: 201`
    ```
    {
    "message": "appliance created success!",
    "data": {
      "id": 1,
      "name": "Geladeira",
      "description": "é uma descrição",
      "marking": "LG",
      "voltage": "220",
      "quantity": 34,
      "updated_at": "2023-07-16T04:11:13.000000Z",
      "created_at": "2023-07-16T04:11:13.000000Z"
      }
    }
    ```

  3.7.2 Caso o nome ja esteja em uso

  `status: 409`
  ```
  {
  "message": "name already in use"
  }
  ```

  3.7.3 Caso esteja faltando um campo

  `status: 400`
  ```
  {
	"message": "field name is missing"
  }
  ```

  3.7.4 Caso a marca esteja invalida

  `status: 400`
  ```
  {
	"message": "Invalid marking value"
  }
  ```

  3.7.5 Caso a voltagem esteja invalida

  `status: 400`
  ```
  {
  	"message": "Invalid voltage value"
  }
  ```


3.8.1 Rota para atualizar o eletrodomésticos  `metodo:pacth Rota:localhost:8000/api/appliances/{id}`:
  
    caso tenha esses campos no body
    marking: "LG" **é um option que aceita somente essas marcas ['electrolux', 'brastemp', 'fischer', 'samsung', 'lg']**
    voltage: "220" **é um option que aceita somente essas voltagems ['110', '220']**

    Exemplo de body:
    ```
      {
        "name": "Geladeira",
        "description": "é uma descrição",
        "marking": "lg",
        "voltage": "220",
        "quantity": 34
      }
    ```

  
  3.8.2 Caso o esteja com todos os dados correto

    `status: 200`

    ```
    {
    	"message": "appliance updated success!",
    	"data": {
    		"id": 2,
    		"name": "Geladeira 2",
    		"image": null,
    		"quantity": 34,
    		"description": "é uma descrição",
    		"marking": "lg",
    		"voltage": "220",
    		"created_at": "2023-07-16T03:45:53.000000Z",
    		"updated_at": "2023-07-16T04:30:11.000000Z"
    	}
    }
    ```

  3.8.3 Caso o nome ja esteja em uso

  `status: 409`
  ```
  {
    "message": "name already in use"
  }
  ```

  3.8.4 Caso o id for invalido

  `status: 404`
  ```
  {
	  "message": "appliance not found!"
  }
  ```

  3.8.6 Caso a marca esteja invalida

  `status: 400`
  ```
  {
	  "message": "Invalid marking value"
  }
  ```

  3.8.6 Caso a voltagem esteja invalida

  `status: 400`
  ```
  {
  	"message": "Invalid voltage value"
  }
  ```

3.9.1 Rota para deletar o eletrodomésticos  `metodo:delete Rota:localhost:8000/api/appliances/{id}`:
  
  3.9.2 Retorno caso o id exista:
  `status: 204`

  3.9.2 Retorno caso o id não exista:
  
  `status: 404 `
  ```
  {
	  "message": "appliance not found!"
  }
  ```
<a name="devs"></a>

## 4. Desenvolvedor

[ Voltar para o topo ](#tabela-de-conteúdos)

- <a name="Gabriel-Fernandes" href="https://www.linkedin.com/in/gabriel-lima-fernandes/" target="_blank">Gabriel Fernandes</a>

<a name="terms"></a>

## 5. Termos de uso

Este é um projeto Open Source para fins educacionais e não comerciais, **Tipo de licença** - <a name="mit" href="https://opensource.org/licenses/MIT" target="_blank">MIT</a>
