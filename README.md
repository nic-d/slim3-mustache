# Slim 3 Mustache
Adds support for [MustachePHP](https://github.com/bobthecow/mustache.php) for rendering views in Slim 3.

## Requirements
* [Slim](http://www.slimframework.com/) 3.0.0 or newer;
* [PHP](http://www.php.net/) 5.6 or newer.

## Install
```
composer require nic-d/slim3-mustache
```

## How to use
```php
// Instantiate Mustache and add to the container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Mustache([
        'loader' => new Mustache_Loader_StringLoader(),
    ]);

    return $view;
};
```