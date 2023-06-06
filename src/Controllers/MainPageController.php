<?php

    namespace App\Controllers;

    use \Api\ApiConnection;
    use \App\Queries\CurrencyQueries;
    use Config\DataBaseConnection;

    define("API_REQUEST", "https://api.nbp.pl/api/exchangerates/tables/A?format=json");

    class MainPageController extends CurrencyQueries
    {
        protected $api_response = null;
        protected $con = null;

        public function __construct()
        {
            $this->api_response = ApiConnection::connect(API_REQUEST);
            $this->con = DataBaseConnection::connect();
        }

        public function showResponse() 
        {
            // run needed function to update table with new price of currencies
            $this->setCurrencies($this->api_response);
        }
    }

?>