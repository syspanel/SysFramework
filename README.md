# 🧩 SysFramework

**Website:** [https://sysframework.syspanel.com.br](https://sysframework.syspanel.com.br)

A **PHP MVC Framework** developed with a robust and modular architecture designed to provide a solid foundation for building scalable and productive web applications.

**Version:** 1.0  
**Year:** 2025  
**Author:** Marco Costa ([sysframework@syspanel.com.br](mailto:sysframework@syspanel.com.br))  
**GitHub:** [github.com/syspanel/SysFramework](https://github.com/syspanel/SysFramework)

---

## ⚙️ Requirements

- PHP 8.3 or higher

---

## 🧠 Tools

1. **SysCli** — Command Line Interface  
2. **SysORM** — Lightweight Object Relational Mapper  
3. **SysTE** — SysFramework Template Engine  
4. **SysRouter** — Routing System with Dependency Injection  
5. **IP Blocking** — Protection against excessive requests  
6. **Request & Response** — PSR-7 compliant HTTP layer  
7. **SysTables** — Table manager and schema handler

---

## 🚀 Installation

1. Extract **SysFramework.zip** into your web root directory (`html` or `/var/www/html`).  
2. Set permissions:
   - `0755` for all folders and files  
   - `0775` for `cache`, `logs`, `storage`, `vendor`  
   - `0644` for `.htaccess` and `public/.htaccess`  
3. Configure your **Apache Virtual Host**:
   ```apache
   <Directory "/var/www/html/sysframework.syspanel.com.br/public">
       Options Indexes FollowSymLinks
       AllowOverride All
       Require all granted
   </Directory>
   ```
4. Create your **database**.  
5. Configure your **.ENV** file.

---

## 🧩 Core Components

- `SysLogger`  
- `SysORM`  
- `SysTE`  
- `SysCli`  
- `SysEnv`  
- `SysImages`  
- `SysSanitize`  
- `Translator`  
- `Validations`  
- `SysMail`  
- `Security`  
- `SysRouter`  
- `SysTables`

---

## 🛠️ Helper Functions

- `assets()`  
- `dd()`  
- `sanitizeMiddleware()`  
- `sanitize()`  
- `generateCsrfToken()`  
- `checkCsrfToken()`  
- `old()`  
- `bcrypt()`  
- `back()`  
- `e()`  
- `blank()`  
- `filled()`

---

## 🌍 External Components

| Library | Link | License |
|----------|------|----------|
| Bootstrap | [twbs/bootstrap](https://github.com/twbs/bootstrap) | MIT |
| PHP-DI | [php-di/php-di](https://github.com/PHP-DI/PHP-DI) | MIT |
| SCEditor | [sceditor/sceditor](https://github.com/samclarke/SCEditor) | MIT |
| EasyCSRF | [gilbitron/easycsrf](https://github.com/gilbitron/EasyCSRF) | MIT |
| Symfony Mailer | [Symfony Mailer Docs](https://symfony.com/doc/current/mailer.html) | MIT |
| Guzzle PSR-7 | [guzzle/psr7](https://github.com/guzzle/psr7) | MIT |

---

## 📘 PSR-7 Compliance

SysFramework follows the [PSR-7: HTTP Message Interface Standard](https://www.php-fig.org/psr/psr-7/), ensuring full interoperability with other PHP components and frameworks.

---

## 💻 SysCli

Run SysCli directly from your project root:

```bash
php syscli Help
```

---

## 🧾 License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).

```
Copyright (c) 2025 Marco Costa

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:
...
```

---

## 💬 Support

📧 Email: [sysframework@syspanel.com.br](mailto:sysframework@syspanel.com.br)

---

## 💖 Support the Project

If you find this project useful, consider supporting its development with a donation via PayPal:

[![Donate via PayPal](https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif)](https://www.paypal.com/donate/?business=marcocosta@gmx.com&currency_code=USD)

---

© 2025 **SysFramework** — Licensed under the [MIT License](https://opensource.org/licenses/MIT).  
Developed by **Marco Costa**.

---
