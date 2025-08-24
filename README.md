SysFramework

sysframework.com

MVC PHP Framework desenvolvido com uma estrutura robusta e modular para fornecer uma base sólida para a criação de aplicações web escaláveis e produtivas.

Versão 1.0

01/10/2025

Marco Costa (marcocosta@gmx.com)

## Requirements

* PHP 8.2 / 8.3

## Ferramentas

1 - SysCli
2 - SysORM
3 - SysTE
4 - SysRouter e Injeção de Dependências
5 - Bloqueio de IP por excesso de requisições
6 - Disponível uso de Request e Response
7 - SysTables

## Installation

1 - Extract SysFramework.zip no diretório html
2 - Ative permissão 0755 em todas as pastas e arquivos
3 - Ative permissão 0775 nos diretórios: cache, logs, storage, vendor
4 - Ative permissão 0644 nos arquivos .htaccess e public/.htaccess
5 - Configuração no Virtual Host Apache2:
    <Directory "/var/www/html/sysframework.com/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
6 - Criar DB
7 - Configure .ENV

## Features

Core:

* Class SysLogger
* Class SysORM
* Class SysTE
* Class SysCli
* Class SysEnv
* Class SysImages
* Class SysSanitize
* Class Translator
* Class Validations
* Class SysMail
* Class Security
* Class SysRouter
* Class SysTables

Helpers:

* assets
* dd()
* sanitizeMiddleware()
* sanitize()
* generateCsrfToken()
* checkCsrfToken()
* old()
* bcrypt()
* back()
* e()
* blank()
* filled()


## Componentes externos

* twbs/bootstrap https://github.com/twbs/bootstrap MIT license
* php-di/php-di https://github.com/PHP-DI/PHP-DI  MIT License
* sceditor/sceditor  https://github.com/samclarke/SCEditor  MIT License
* gilbitron/easycsrf  https://github.com/gilbitron/EasyCSRF  MIT License
* Symfony's Mailer https://symfony.com/doc/current/mailer.html  MIT License
* guzzle/psr7  https://github.com/guzzle/psr7 MIT License


## PSR-7

https://www.php-fig.org/psr/psr-7/


## SysCli

php syscli Help 


## Suporte

Email: marcocosta@gmx.com


📜 Terms of Use

This project is licensed under the MIT License.

You can use, copy, modify, merge, publish, distribute, sublicense, or sell copies of the Software, as long as the license and copyright notice are included in all copies or substantial portions of the Software.

The Software is provided "as is", without warranties of any kind. For more details, see the MIT License.

For more information, contact: marcocosta@gmx.com

### Support the Project
If you find this project useful, consider supporting its development with a donation via PayPal:

[![Donate via PayPal](https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif)](https://www.paypal.com/donate/?business=marcocosta@gmx.com&currency_code=USD)

© 2025 Marco Costa - All rights reserved under the MIT License.
