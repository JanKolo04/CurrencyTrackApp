<?php

    namespace App\Controllers;

    class CurrencyConverterController extends BaseController
    {
        private $error_messages = array();

        /**
         * validationData() method to valid entered data
         * 
         * @return void
         */
        private function validationData(): void
        {   
            // check what has not been selected or entered and add new data into array with error messages
            if(empty($_POST['ammount'])) {
                $this->error_messages += array("ammount" => "Ammount has not been entered");
            }
            if(empty($_POST['first_currency'])) {
                $this->error_messages += array("first_currency" => "First currency has been not selected");
            }
            if(empty($_POST['second_currency'])) {
                $this->error_messages += array("second_currency" => "Second currency has been not selected");
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
                
                // check whther $error_messages array is empty
                if(empty($this->error_messages)) {
                    // run method convertCurrency()
                    $convertedAmmount = $this->convertCurrency($_POST['ammount'], $_POST['first_currency'], $_POST['second_currency']);
                    // upload last convert into database
                    $this->lastConvertsQueries->uploadConvert($_POST['ammount'], $convertedAmmount, $_POST['first_currency'], $_POST['second_currency']);
                    
                    // run method to render page for Currency converter
                    $this->renderCurrencyConverterPage($_POST, null, $convertedAmmount);
                }
                else {
                    $this->renderCurrencyConverterPage($_POST, $this->error_messages, null);
                }
            }
            else {
                // run method to render page for Currency converter
                $this->renderCurrencyConverterPage($_POST, $this->error_messages, null);
            }
        }
    }

?>