<?php

    namespace Config;

    use App\Controllers;

    class Routes {
        public $file;

        public function __construct() {
            // create ternary operator with $_SERVER['REDIRECT_URL'] for $file variable
            // if $_SERVER['REDIRECT_URL'] is not empty get value of $_SERVER['REDIRECT_URL'] and set to $file
            // but if is set "" for $file 
            $this->file = !empty($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : "";
        }
        
        public function checkCorrectnessOfRequest() {
            // check whether request is in switch
            switch($this->file) {
                case(''):
                    $mainPage = new Controllers\MainPageController();
                    $mainPage->show();
                    break;
                case('/CurrencyTrackApp/currency-converter'):
                    #include("src/Controllers/CurrencyConverterController.php");
                    $currencyConverter = new Controllers\CurrencyConverterController();
                    $currencyConverter->show();
                    break;
                default:
                    echo $this->file;
            }
        }
    }

?>