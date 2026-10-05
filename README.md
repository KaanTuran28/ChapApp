# ChapApp — PHP Chat Application

![PHP](https://img.shields.io/badge/PHP-MySQL-777bb4)
![License](https://img.shields.io/badge/license-MIT-green)

<p align="center"><b><a href="#english">English</a></b> · <b><a href="#türkçe">Türkçe</a></b></p>

---

## English

A simple web-based chat application built with PHP and MySQL. Users can sign up, log in, search for other users and exchange messages. It was a learning project for server-side PHP, sessions and a MySQL backend.

### Features

- Sign up and log in with session-based authentication.
- Password reset by email (PHPMailer).
- User search and a profile page.
- One-to-one messaging stored in MySQL.

### Tech stack

- PHP (vanilla, no framework)
- MySQL (`chatapp` database)
- PHPMailer (via Composer) for the password-reset email
- HTML / CSS / JavaScript on the front end

### Setup

1. Copy the project under a PHP server's web root (XAMPP/WAMP `htdocs`, or `php -S localhost:8000`).
2. Create a MySQL database named `chatapp` and the tables used by the app (users and messages).
3. Set your database credentials in `php/config.php`.
4. Run `composer install` to pull in PHPMailer, and set the mail credentials used in the password-reset scripts.
5. Open the app in a browser and sign up.

### Structure

```
├── index.php / login.php / chat.php / profil.php / users.php
├── header.php
├── php/              # config, login, signup, chat, search endpoints
├── Sifre_yenileme/   # password reset flow
├── javascript/       # chat, login, signup, users scripts
├── css/
└── composer.json     # PHPMailer dependency
```

> **Note:** This is an early learning project. Before any real use, the database credentials should be moved out of source control and the SQL queries hardened against injection.

### License

MIT — see [LICENSE](./LICENSE).

---

## Türkçe

PHP ve MySQL ile yapılmış basit, web tabanlı bir sohbet uygulaması. Kullanıcılar kayıt olabilir, giriş yapabilir, başka kullanıcıları arayabilir ve mesajlaşabilir. Sunucu tarafı PHP, oturum (session) yönetimi ve MySQL arka ucu öğrenmek için yapılmış bir projedir.

### Özellikler

- Oturum tabanlı kayıt ve giriş.
- E-posta ile şifre sıfırlama (PHPMailer).
- Kullanıcı arama ve profil sayfası.
- MySQL'de saklanan birebir mesajlaşma.

### Kullanılan teknolojiler

- PHP (framework'süz)
- MySQL (`chatapp` veritabanı)
- PHPMailer (Composer ile) — şifre sıfırlama e-postası için
- Ön yüzde HTML / CSS / JavaScript

### Kurulum

1. Projeyi bir PHP sunucusunun kök dizinine koyun (XAMPP/WAMP `htdocs` veya `php -S localhost:8000`).
2. `chatapp` adında bir MySQL veritabanı ve uygulamanın kullandığı tabloları (kullanıcılar ve mesajlar) oluşturun.
3. Veritabanı bilgilerinizi `php/config.php` içine yazın.
4. PHPMailer için `composer install` çalıştırın ve şifre sıfırlama betiklerindeki posta bilgilerini ayarlayın.
5. Uygulamayı tarayıcıda açıp kayıt olun.

### Yapı

```
├── index.php / login.php / chat.php / profil.php / users.php
├── header.php
├── php/              # config, giriş, kayıt, sohbet, arama uçları
├── Sifre_yenileme/   # şifre sıfırlama akışı
├── javascript/       # sohbet, giriş, kayıt, kullanıcı betikleri
├── css/
└── composer.json     # PHPMailer bağımlılığı
```

> **Not:** Bu erken dönem bir öğrenme projesidir. Gerçek bir kullanımdan önce veritabanı bilgileri sürüm kontrolünden çıkarılmalı ve SQL sorguları enjeksiyona karşı sağlamlaştırılmalıdır.

### Lisans

MIT — bkz. [LICENSE](./LICENSE).
