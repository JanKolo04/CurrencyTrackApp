<?php

    namespace App\Controllers;

    class CurrencyConverterController extends BaseController
    {
        private $errors = array();

        /**
         * validationData() method to valid entered data
         * 
         * @return void
         */
        private function validationData(): void
        {
            // check what has not been selected or entered and add new data into array with error messages
            if(empty($_POST['ammount']) && $_POST['ammount'] != 0) {
                $this->errors += array('ammount' => array(
                    "message" => "Kwota nie została wpisana",
                    "invalid" => "is-invalid"
                ));
            }
            if(empty($_POST['first_currency'])) {
                $this->errors += array('first_currency' => array(
                    "message" => "Waluta źródłowa nie została wybrana",
                    "invalid" => "is-invalid"
                ));
            }
            if(empty($_POST['second_currency'])) {
                $this->errors += array('second_currency' => array(
                    "message" => "Waluta docelowa nie została wybrana", 
                    "invalid" => "is-invalid"
                ));
            }
            
            // if ammount is less than 1 or more than 100000000 return error on ammount input
            if($_POST['ammount'] < 1 || $_POST['ammount'] > 100000000) {
                $this->errors += array('ammount' => array(
                    "message" => "Kwota nie może być mniejsza niż 1 i większa niż 100000000",
                    "invalid" => "is-invalid"
                ));
            }
        }

        /**
         * getExchangeRate() method to calculate exchange between two currencies
         * 
         * @param string $firstCode code of first selected currency
         * @param string $secondCode code of second selected currency
         * @return float
         */
        private function getExchangeRate(string $firstCode, string $secondCode): float
        {
            // get price of first and second currency
            $firstCurrencyPrice = $this->currencyQueries->findCurrencyByCode($firstCode);
            $secondCurrencyPrice = $this->currencyQueries->findCurrencyByCode($secondCode);

            // calculate exchangeRate between first and second currency
            $exchangeRate = $firstCurrencyPrice / $secondCurrencyPrice;

            return $exchangeRate;
        }

        /**
         * convertCurrency() method to convert ammount in first select currency to second selected currency
         * 
         * @param int $ammount entered ammount
         * @param string $firstCode code of first selected currency
         * @param string $secondCode code of second selected currency
         * @return float
         */
        private function convertCurrency(int $ammount, string $firstCode, string $secondCode): float
        {   
            // calculate exchange rate bettween two currencies
            $exchangeRate = $this->getExchangeRate($firstCode, $secondCode);
            
            // convert entered ammount of first currency to second
            $convertedAmmount = $ammount * $exchangeRate;

            // round to two decimals
            $convertedAmmount = round($convertedAmmount, 2);

            return $convertedAmmount;
        }

        /**
         * show() method to make lasts operation which are necessary to render page
         * 
         * @return void
         */
        public function show(): void
        {   
            // update currency data to work with fresh data
            $this->currencyQueries->setCurrencies($this->api_response);

            // check whether user click convert button
            if(isset($_POST['convert'])) {
                // run method with validation
                $this->validationData();
                
                // check whther $errors array is empty
                if(empty($this->errors)) {
                    // run method convertCurrency()
                    $convertedAmmount = $this->convertCurrency($_POST['ammount'], $_POST['first_currency'], $_POST['second_currency']);
                    // upload last convert into database
                    $this->lastConvertsQueries->uploadConvert($_POST['ammount'], $convertedAmmount, $_POST['first_currency'], $_POST['second_currency']);
                    
                    // run method to render page for Currency converter
                    $this->renderCurrencyConverterPage($_POST, null, $convertedAmmount);
                }
                else {
                    $this->renderCurrencyConverterPage($_POST, $this->errors, null);
                }
            }
            else {
                // run method to render page for Currency converter
                $this->renderCurrencyConverterPage($_POST, $this->errors, null);
            }
        }
    }

?>