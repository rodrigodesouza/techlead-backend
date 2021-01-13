### Passos iniciais do projeto

- composer install
- copiar o arquivo .env.example como .env
- executar o comando: ```php artisan key:generate```
- colocar os dados de acesso ao BD no arquivo .env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=banco
DB_USERNAME=root
DB_PASSWORD=password
- executar o comando ```php artisan dashboard:install```
- para usar o servidor do Laravel: ```php artisan serve```
- Acesso ao painel administrativo:
http://127.0.0.1:8000/controle
Login: admin@admin.com
Senha: 12345678
- Área do cliente:
http://127.0.0.1:8000/
