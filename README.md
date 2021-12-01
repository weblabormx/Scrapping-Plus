# Scrapping Plus

Laravel package for scrapping with different drivers.

This package will help you for scrapping any website, even the ones done completly by javascript. This is done thanks the different drivers that handles the scrapping.

In this package we use the next drivers

- Parser (paquettg/php-html-parser)
- Laravel Dusk (laravel/dusk)
- Voku (voku/simple_html_dom)

## Installation

You can install the package via composer:

```bash
composer require weblabormx/scrapping-plus
```

## Usage

For using the Parser one you need to execute something like this.

``` php
use WeblaborMX\ScrappingPlus\Scrapping;

// Using html directly
$scrapper = Scrapping::fromHtml('<html><body><h1>Hola</h1><p>Excerpt</p></body></html>');
$h1 = $scrapper->first('h1');
$text = $h1->getText(); // Hola

// Get it from an URL
$google = Scrapping::scrappe('https://www.google.com.mx');
$html = $google->getHtml();

// Access inputs
$inputs = $google->get('input');
$this->assertEquals(5, $inputs->count());

$first = $inputs->first();
$second = $inputs[1];

$class = $google->first('input[name=btnI]');
$title = $class->getAttribute('value');
```

And if you want to execute it with laravel dusk you just need to execute something like this:

``` php
$page = Scrapping::method('dusk')->scrappe($url);
$page->object->waitForText($text); // How to use laravel dusk functions directly
$page = $page->toParser(); // Convert to the parser driver
```

The list of functions that every driver has are the next ones:
- `get($selector)`
- `getHtml`
- `getAttribute($name)`
- `getLink`
- `getText`

### Testing

``` bash
phpunit test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email carlosescobar@weblabor.mx instead of using the issue tracker.

## Emailware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending an email with the url of the website in production to add it to our website

Our email address is: carlosescobar@weblabor.mx

We publish all received emails [on our company website](http://weblabor.mx).

## Credits

- [Carlos Escobar](https://github.com/skalero01)
- [All Contributors](../../contributors)

## Support us

Weblabor is a web design agency based in México. You'll find an overview of all our open source projects [on our website](http://weblabor.mx).

Does your business depend on our contributions? Reach out and support us
All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

- Support us on Patreon - https://www.patreon.com/weblabormx
- Support us with a Paypal donation - https://paypal.me/weblabormx 


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
