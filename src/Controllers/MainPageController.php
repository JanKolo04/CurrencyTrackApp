<?php

    namespace App\Controllers;

    class MainPageController extends BaseController
    {
        /**
         * show() method to render main page with twig
         * 
         * @return void
         */
        public function show(): void
        {
            // update currency data
            $this->updateCurrencyData();
            
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
