<p align="center">
    <a href="http://1er.ir/" target="_blank">
        <img src="http://1er.ir/img/logo.png" height="100px">
    </a>
    <h1 align="center">A simple link shortener</h1>
    from <a href="http://1er.ir/"/> 1er.ir </a> project
    
    <br>
</p>


DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      modules/            contains REST Api Modules
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



INSTALLATION
------------

### Clone and install

~~~
git clone https://github.com/kh26127/1er.git
~~~

or download from :

~~~
https://github.com/kh26127/1er/archive/master.zip
~~~

and run 
~~~
composer install
~~~
CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, and run this command for install migrations

```
yii migrate
```


TESTING
-------

For run  Api Test user this command

```
vendor/bin/codecept run api
```
The command above will execute API tests.


