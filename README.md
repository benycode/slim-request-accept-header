# Slim 4 request accept header parser

Parse accept headers

## Table of contents

- [Install](#install)
- [Usage](#usage)

## Install

Via Composer

``` bash
$ composer require benycode/slim-request-accept-header
```

Requires Slim 4.

## Usage

Use [DI](https://www.slimframework.com/docs/v4/concepts/di.html) to inject the library Middleware classes:

```php
use Psr\Container\ContainerInterface;
use BenyCode\Slim\RequestAcceptHeader\LanguageDetectMiddleware;

return [
    ......
  LanguageDetectMiddleware::class => function (ContainerInterface $container): LanguageDetectMiddleware {
		
      return new LanguageDetectMiddleware(
        'lt', 
        ['lt', 'en'],
      );
  },
];
```

add a **Middlewares** to route globaly:

```php
use BenyCode\Slim\RequestAcceptHeader\LanguageDetectMiddleware;

$app
  ...
  ->add(LanguageDetectMiddleware::class)
  ;
  ...
```

now your Slim can detect a language.
