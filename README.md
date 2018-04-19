# Gutter\Cookies
Nette extension for communication between PHP Sessions and browser cookies.

## Installation

The best way to install Gutter\Cookies is via [Composer](http://getcomposer.org/):
```
$ composer require gutter/cookies
```
## Usage
You can use the Cookies as an extension.
### Configuration
First you have to set the extension up in `config.neon`.
```
extensions:
    cookies: Gutter\Cookies\DI\CookiesExtension

cookies:
    maxAge: 365 days
```
### Implementation
The usage in the code is demonstrated in `tests/Manager.phpt`.
## Development
### Running tests
You can run Unit tests like this: `php7.2 vendor/bin/phpunit --bootstrap vendor/autoload.php tests/ManagerTest.php`