# laravel-with-passport


## Instalar as dependências:

Instalando as dependências: `composer update --no-scripts`

## Configurando o Passport

Intalar o Passport no projeto: `composer require laravel/passport`

Configure o banco no arquivo .env e então execute a migration: `php artisan migrate`

Esse irá criar a chaves de encriptação necessárias para gerar o access_token: `php artisan passport:install`

Usar migration customizadas do Passport: `php artisan vendor:publish --tag=passport-migrations`

Publicar o Passport Vue components: `php artisan vendor:publish --tag=passport-components`

Documentação do Passport: https://laravel.com/docs/5.8/passport

## Rotas da API

**Login**

**Enpoint:** `/api/login`

**Method:** `Post`

**Json:**

`
{
"email": "usuario@email.com",
"password": "password here..."
}
`

<br>
**Logout**

**Enpoint:** `/api/logout`

**Method:** `Get`

<br>
**Register**

**Enpoint:** `/api/register`

**Method:** `Post`

**Json:**

`
{
"name": "Name....",
"email": "usuario@email.com",
"password": "password here..."
}
`

<br>
**User**

**Enpoint:** `/api/user`

**Method:** `Get`


**OBS:** Nos endpoints user e logout é necessário passar o token no header da requisição.




**Exemplo:**

```
$ch = curl_init();

$authorization = 'Authorization: Bearer '.$token;

curl_setopt_array($ch, [
    CURLOPT_URL => 'http://localhost:8000/api/user',
 	CURLOPT_POST => false,
   	CURLOPT_HTTPHEADER => array('Content-Type: application/json' , $authorization ),
   	CURLOPT_RETURNTRANSFER => true
]);

$resultado = curl_exec($ch);
$json = json_decode($resultado);
echo $resultado;

curl_close($ch);
```