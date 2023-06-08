<?php

    namespace App\Controllers;

    class CurrencyConverterController extends BaseController
    {
        private $error_messages = array();
        private $convertedAmmount = null;

        private function validationData(int $ammount, string $firstCurrency, string $secondCurrency): void
        {   
            // check what has not been selected or entered and add new data into array with error messages
            if(empty($ammount)) {
                $this->error_messages += array("ammount" => "Ammount has not been entered");
            }
            else if(empty($firstCurrency)) {
                $this->error_messages += array("first_currency" => "First currency has been not selected");
            }
            else if(empty($secondCurrency)) {
                $this->error_messages += array("second_currency" => "Second currency has been not selected");
            }
        }

        private function getExchangeRate(string $firstCode, string $secondCode): float
        {
            // get price of first and second currency
            $firstCurrencyPrice = $this->currencyQueries->findCurrencyByCode($firstCode);
            $secondCurrencyPrice = $this->currencyQueries->findCurrencyByCode($secondCode);

            // calculate exchangeRate between first and second currency
            $exchangeRate = $firstCurrencyPrice / $secondCurrencyPrice;

            return $exchangeRate;
        }

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

        public function show(): void
        {   
            // update currency data to work with fresh data
            $this->updateCurrencyData();

            // check whether user click convert button
            if(isset($_POST['convert'])) {
                // run method with validation
                $this->validationData($_POST['ammount'], $_POST['first_currency'], $_POST['second_currency']);
                
                // check whther $error_messages array is empty
                if(empty($this->error_messages)) {
                    // run method convertCurrency()
                    $this->convertedAmmount = $this->convertCurrency($_POST['ammount'], $_POST['first_currency'], $_POST['second_currency']);
                    echo $this->twig->render(
                        "currency_converter.html.twig",
                        [
                            "request_data" => $_POST,
                            "converted_ammount" => $this->convertedAmmount
                        ]
                    );
                }
            }
            else {
                echo $this->twig->render(
                    "currency_converter.html.twig",
                    [   
                        "request_data" => $_POST,
                        "error_messages" => $this->error_messages
                    ]
                );
            }
        }
    }

?>