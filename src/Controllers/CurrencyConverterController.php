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

        private function convertCurrency(int $ammount, string $firstCode, string $secondCode): float
        {   
            // get price of first and second currency
            $secondCurrencyPrice = $this->currencyQueries->findCurrencyByCode($firstCode);
            $firstCurrencyPrice = $this->currencyQueries->findCurrencyByCode($secondCode);

            // calculate exchangeRate between first and second currency
            $exchangeRate = $firstCurrencyPrice / $secondCurrencyPrice;

            // convert entered ammount of first currency to second
            $convertedAmmount = $ammount * $exchangeRate;

            return $convertedAmmount;
        }

        public function show(): void
        {
            $this->validationData($_POST['ammount'], $_POST['first_currency'], $_POST['second_currency']);
            
            if(!empty($this->error_messages)) {
                $this->convertedAmmount = $this->convertCurrency($_POST['ammount'], $_POST['first_currency'], $_POST['second_currency']);
            }

            echo $this->twig->render(
                "currency_converter.html.twig",
                [
                    "ammount" => $_POST['ammount'],
                    "first_currency" => $_POST['first_currency'],
                    "second_currency" => $_POST['second_currency'],
                    "converted_ammount" => $this->convertedAmmount,
                    "error_messages" => $this->error_messages
                ]
            );
        }
    }

?>