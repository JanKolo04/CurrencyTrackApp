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
            // update currency data to work with fresh data
            $this->currencyQueries->setCurrencies($this->api_response);
            
            // fetch all currencies from databse
            $currencies = $this->currencyQueries->getCurrencies();

            // render template 'main.html.twig' and pass to him currencies two-dimensional array
            $this->renderMainPage($currencies);
        }
    }

?>
