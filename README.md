Symfony Application : Adopte Ton Compagnon
========================

Adopte Ton Compagnon is a `symfony` application where the user can register and login to  adopt a pet and buy products that are available.
What we have used in this project :
- Forms
- Services
- Sessions
- Databases and the Doctrine ORM
...

Requirements
------------

  * PHP 7.3 or higher;
  * and the [usual Symfony application requirements][2].

Installation
------------

[Download Symfony][4] to install the `symfony` binary on your computer and run
this command:

```bash
$ symfony new --demo adopteTonCompagnon
```

Alternatively, you can use Composer:

```bash
$ composer create-project symfony/symfony-demo adopteTonCompagnon
```

Fixtures
------------
Run this command in order to generate fake data for de DB(tables: article, product, animal)

```bash
$ php bin/console doctrine:fixtures:load
```

Usage
-----

There's no need to configure anything to run the application. If you have
[installed Symfony][4] binary, run this command:

```bash
$ cd adopteTonCompagnon/
$ symfony serve:start
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

If you don't have the Symfony binary installed, run `php -S localhost:8000 -t public/`
to use the built-in PHP web server or [configure a web server][3] like Nginx or
Apache to run the application.

Group
-----
- Abderrafii RABAH
- Reda BENYOUB
- Louison DONNE
- Massi DJELLOULI

[1]: https://symfony.com/doc/current/best_practices.html
[2]: https://symfony.com/doc/current/reference/requirements.html
[3]: https://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
[4]: https://symfony.com/download
