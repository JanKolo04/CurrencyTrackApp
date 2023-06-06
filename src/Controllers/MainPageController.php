<?php

    namespace App\Controllers;

    use Api\ApiConnection;
    use App\Queries\CurrencyQueries;
    use App\Views\CurrencyTable;

    define("API_REQUEST", "https://api.nbp.pl/api/exchangerates/tables/A?format=json");

    class MainPageController extends CurrencyTable
    {
        protected $api_response = null;
        protected $currencyQueries = null;

        public function __construct()
        {
            $this->api_response = ApiConnection::connect(API_REQUEST);
            $this->currencyQueries = new CurrencyQueries();
        }

        public function showResponse(): void
        {
            // run needed function to update table with price of currencies or add news
            $this->currencyQueries->setCurrencies($this->api_response);
            $this->showTable();
        }
    }

?>