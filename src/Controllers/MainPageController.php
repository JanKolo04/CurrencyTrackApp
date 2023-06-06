<?php

    namespace App\Controllers;

    use Api\ApiConnection;

    define("API_REQUEST", "https://api.nbp.pl/api/exchangerates/tables/A?format=json");

    class MainPageController extends BaseController
    {
        private $api_response = null;

        /**
         * setApiResponse() method to set value into $api_response property and I decidet to put this here
         * not in BaseController, because every controller will be have it's own api response
         * 
         * @return void
         */
        private function setApiResponse(): void
        {
            $this->api_response = ApiConnection::connect(API_REQUEST);
        }

        /**
         * show() method to render main page with twig
         * 
         * @return void
         */
        public function show(): void
        {
            // run setApiResponse
            $this->setApiResponse();
            // run function setCurrencies() to update table with price of currencies or add news
            $this->currencyQueries->setCurrencies($this->api_response);
            // fetch all currencies from databse
            $currencies = $this->currencyQueries->getCurrencies();

            // render template 'main.html.twig' and pass to him currencies two-dimensional array
            echo $this->twig->render(
                "main.html.twig",
                ["currencies" => $currencies]
            );
        }
    }
    
?>
