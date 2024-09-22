# PHP CLI app

## Task Description:

Create a CLI application that will let log donations to specific charities

### The donation should have the following fields:

- id
- donor name
- amount
- charity id
- date time

### Charity should have the following fields:

- id
- name
- representative email

### The application should have the following functionality:

- View charities
- Add charity
- Edit charity
- Delete charity
- Add donation

### Requirements:

- Do not use any frameworks or packages.
- Do validation (valid email, donation, etc.)
- Write code using the best OOP practices.
- Add the ability to import charities in CSV format.
- Push your code to a Git repository (e.g., GitHub, GitLab, Bitbucket) and share the link with us.

## Setup

### 1. Clone repository

First of all clone **_PHP CLI app_** repository, it can be done using this command using *
*Command Prompt**:

```bash
git clone -b PHP-Only https://github.com/ErnestasFil/PHP-CLI-app.git
```

### 2. PHP settings and version

This code was wrote using **_PHP 8.2_** version. It's important that in **_php.ini_** should be enabled few extensions!

```bash
extension=pdo_sqlite            // this CLI application use SQLite database
extension=mbstring              // to handle multibyte encodings like UTF-8
```

### 3. Run CLI application

To use this CLI application use this command:

```bash
php main.php
```

### Windows/Linux

This application was tested using 2 OS: Windows 10 and Debian linux
