# Requisitos
PHP 5.6+
MySQL

#Instalação
Crie o banco de dados utilizando o arquivo: seminar.sql.

Copie o arquivo config/autoload/development.local.php.dist para config/autoload/development.local.php abra o arquivo e altere o usuário e a senha do banco de dados.

Na linha de comando entre na pasta do projeto e digite:
php composer.phar install

# Uso

Na linha de comando entre na pasta do projeto e digite:
php -S 0.0.0.0:8080 -t public public/index.php

O servidor estará disponível no seguinte endereço:
http://localhost:8080/

