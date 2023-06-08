<?php

    namespace App\Controllers;

    use App\Queries\CurrencyQueries;
    use Config\TwigConfig;
    use Api\ApiConnection;
    
    // constant variable with url for api
    define("API_REQUEST", "https://api.nbp.pl/api/exchangerates/tables/A?format=json");

    class BaseController
    {
        protected $currencyQueries = null;
        protected $twig = null;
        private $api_response = null;

        public function __construct()
        {
            $this->currencyQueries = new CurrencyQueries();
            $this->twig = TwigConfig::create();
            $this->api_response = ApiConnection::connect(API_REQUEST);
        }

        /**
         * updateCurrencyData() method to update or insert currency data which are in databse
         * 
         * @return void
         */
        protected function updateCurrencyData(): void
        {
            $this->currencyQueries->setCurrencies($this->api_response);
        }

        protected function renderCurrencyConverterPage(array $request_data, ?array $error_messages, ?float $convertedAmmount)
        {
            // if $convertedAmmount isn't null add to results section class to show
            $displayResults = "hidde";
            if($convertedAmmount != null) {
                $displayResults = "show";
            }

            echo $this->twig->render(
                "currency_converter.html.twig",
                [   
                    "converted_ammount" => $convertedAmmount,
                    "request_data" => $request_data,
                    "error_messages" => $error_messages,
                    "displayResults" => $displayResults
                ]
            );
        }
    }

?>