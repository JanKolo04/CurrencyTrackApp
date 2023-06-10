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

        /**
         * renderCurrencyConverterPage() method to render page for currency converter make 
         * some operations which are necessary
         * 
         * @param array $request_data assoc array which user send in form
         * @param array|null $errors assoc array with errors
         * @param float|null $convertedAmmount converted ammount from first to second currency
         * @return void
         */
        protected function renderCurrencyConverterPage(array $request_data, ?array $errors, ?float $convertedAmmount): void
        {
            // if $convertedAmmount isn't null add to results section class to show
            $displayResults = "hidde";
            if($convertedAmmount != null) {
                $displayResults = "show";
            }

            // get all currencies
            $currencies = $this->currencyQueries->getCurrencies();

            // get lasts converts
            $lastConverts = $this->lastConvertsQueries->getConverts();
            
            // render page
            echo $this->twig->render(
                "currency_converter.html.twig",
                [   
                    "converted_ammount" => $convertedAmmount,
                    "request_data" => $request_data,
                    "errors" => $errors,
                    "displayResults" => $displayResults,
                    "currencies" => $currencies,
                    "converts" => $lastConverts
                ]
            );
        }
    }

?>