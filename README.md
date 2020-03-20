# Teste segunda fase

## Instalando o projeto

Clone o repositório ou baixe o arquivo zip.

```bash
git clone https://github.com/tjgazel/teste-segunda-fase.git
```

Acesse o diretório api e use o composer para baixar as dependências.

```bash
composer update
```

<br>

## Configurando ambiente local com Docker.

A api foi desenvolvida com Lumen. O arquivo `.env` já está previamente configurado para uso com
os container Docker.

Com o terminal no diretório raiz do projeto, suba os containers docker.

```bash
docker-compose up -d
```

#### Serviços disponíveis

- O container `app` ira espelhar o diretório do progeto.

- O container `api_webserver` irá mapear a porta `8001` para a API `(localhost:8001)`.

- O container `webserver` irá mapear a porta `8002` para o serviço Web `(localhost:8002)`.

- O container `db` vai servir o banco de dados MySQL 5.7. Para acessar o db externamente, use a porta `3307`

<br> 
 
Depois que o docker criar os containers você deve configurar no container `db`, 
as permissões do usuário `lumen` para o banco `teste`.

```bash
docker-compose exec db bash

// Ao conectar no container acesse o mysql com a senha root e password root
mysql -uroot -proot

GRANT ALL ON teste.* TO 'lumen'@'%' IDENTIFIED BY 'root';
GRANT ALL ON teste.* TO 'lumen'@'localhost' IDENTIFIED BY 'root';

flush privileges;

exit;
exit;
```

Rodar as migrações e seeders no container `app`

```bash
docker-compose exec app bash
cd api
php artisan migrate --seed
```

### Rodando a aplicação com ambiente docker.

Acesse no navegador http://localhost:8002.

Email: `admin@gmail.com` <br>
Senha: `123456`

<br>

## Configurando ambiente sem docker.

#### API

Configure uma conexâo a seu critério com um banco de dados local no arquivo `.env`.
Diretório `api`.

```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=teste
DB_USERNAME=lumen
DB_PASSWORD=root
```

Com o terminal no diretório `api`, rodar as `migrações e seeders`.

```bash
php artisan migrate --seed
```

Ainda no diretório `api` Inicie um servidor web utilizando o PHP na porta 8001.
A porta da api é muito importante pois o projeto frontend está configurado para
realizar a chamada nesta porta.

```bash
php -S localhost:8001 -t public
```

#### Frontend

Acesse a pasta `web` com o terminal e inicie o servidor com o `npm`.

```bash
npm run serve
```

Acesse no navegador http://localhost:8080
