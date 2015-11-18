google-scraper
==============

Simple scraper of google results using the Google API

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      config/             contains application configurations
      controllers/        contains Web controller classes
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install from an Archive File

Extract the archive file in 
a directory named `google-scraper` that is directly under the Web root.

You can then access the application through the following URL:

~~~
http://localhost/google-scraper/web/
~~~


### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install dependencies using the following commands:

~~~
php composer.phar global require "fxp/composer-asset-plugin:~1.1.0"
php composer.phar update
~~~

Now you should be able to access the application through the following URL, assuming `google-scraper` is the directory
directly under the Web root.

~~~
http://localhost/google-scraper/web/
~~~


CONFIGURATION
-------------

### Google API key

Obtain a Google API key. Edit the file `config/secret.php` with real data, for example:

```php
return [
    'apikey' => 'foobar42'
];
```

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=google-scraper',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```


Run migrations to create the database:

```
./yii migrate
```
