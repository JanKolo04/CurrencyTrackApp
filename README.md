
# CurrencyTrackApp

App to tracking currency value and trading from one to another.

## [Installation](#installation)

Install CurrencyTrackApp with git:

```bash
git clone https://github.com/JanKolo04/CurrencyTrackApp.git
```

**After download project into your computer you need XAMPP to host project on localhost. Click [here](https://www.apachefriends.org/pl/download.html) to install.** When you install XAMPP you have to add move project into `htdocs` directory.

Also really important fings is import data base. With XAMPP you can open http://localhost/phpmyadmin and upload data base which is in file `currency_tracker.sql`. 

Install composer to be able to use the work. Click [here](https://getcomposer.org/download/) to install.

Download needed requirements into project which are in `composer.json`:
```bash
composer install
```
Used packages:
- twig/twig: ^3.6

And after all instalations you can open project http://localhost/CurrencyTrackApp/
## [Usage/Examples](#usage-examples)

Here is a part of `BaseController` which is basic controller which is extends in every controller. In firts lines I define namespace, import classes and set define const variable which is called `API_REQUEST` and its value is link into nbp api. In this part od class you can see `__construct` method which set value for properties.
```php
<?php

  namespace App\Controllers;

  use App\Queries\CurrencyQueries;
  use App\Queries\LastConvertsQueries;
  use Config\TwigConfig;
  use Api\ApiConnection;

  // constant variable with url for api
  define("API_REQUEST", "https://api.nbp.pl/api/exchangerates/tables/A?format=json");

  class BaseController
  {
      protected $currencyQueries = null;
      protected $lastConvertsQueries = null;
      protected $twig = null;
      protected $api_response = null;

      public function __construct()
      {
          $this->currencyQueries = new CurrencyQueries();
          $this->lastConvertsQueries = new LastConvertsQueries();
          $this->twig = TwigConfig::create();
          $this->api_response = ApiConnection::connect(API_REQUEST);
      }

      ...
?>
```

I render pages from Controllers with `twig` because is perfect tool to have good connection from backend to forntend. Here is example how I render page with twig:

```php
<?php
  /**
  * renderMainPage() method to render main page
  * 
  * @param object $currencies two-dimencional array with data about currencies
  * @return void
  */
  protected function renderMainPage(object $currencies): void
  {   
    // render page
    echo $this->twig->render(
        "main.html.twig",
        ["currencies" => $currencies]
    );
  }
?>
```
Render method which I evoks I pass two data, `main.html.twig` which is file which have to render and assoc array with data to pass into template. Whole twig config is in `/config/TwigConfig.php`.
## [Demo](#demo)

To check how this app works you can visit this website https://currencytrackerapp.pl.

