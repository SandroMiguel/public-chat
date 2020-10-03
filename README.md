**DEPRECATED** - this repository is no longer being maintained.

# Public chat v.0.4

Public chat room using PHP

Complete tutorial (em português): https://www.revista-programar.info/artigos/sistema-de-chat-publico-em-php/

## Introduction

Although the basis of this system is PHP, other technologies will also be used. Our toolbox then has the following content and its usage:

- PHP: Main programming language;
- HTML: Page structure;
- CSS: Style of the pages;
- JQuery / JavaScript: Using AJAX;
- MySQL / MariaDB: Database;
- Apache: Web server.

## Goal

At the end of this article the reader will have a comprehensive overview of what is essential to creating web applications and the help needed to start breaking this world with PHP.

## Features

This chat system will have the following features:

- Single public chat room;
- Choose a unique nickname;
- Sending messages;
- Receiving messages.

## Tool box

To implement this chat we will use several tools that complement each other. Some of these tools have been installed with XAMPP, allowing you to easily install a web server on your local machine.

## PHP

PHP, a recursive acronym for "PHP: Hypertext Preprocessor" (originally Personal Home Page) is a free and open source server-side programming language. PHP is, for example, used by Facebook and WordPress. In 2014 was the language of choice for 82% of websites (where programming language is known).
In this chat system, which we are going to build, PHP has the function of communicating with the database for storing and querying messages.

## MySQL

MySQL is a Database Management System (DBMS) that uses the SQL (Structured Query Language). His license is free for development, but if it is used in commercial applications, it will be paid. Used by NASA, Friendster, HP, Google, among other companies, it is currently one of the most popular databases with more than 10 million installations worldwide.
The function of MySQL in our chat system is storing user messages (MariaDB can also be used). Two tables will be used, one to store the nicknames and another to store the messages.

## License

_Public chat_ is freely distributable under the terms of the [MIT license](https://github.com/SandroMiguel/public-chat/blob/master/LICENSE).
