<?php

    namespace App\Controllers;

    use App\Queries\CurrencyQueries;
    use Config\TwigConfig;

    class BaseController
    {
        protected $currencyQueries = null;
        protected $twig = null;

        public function __construct()
        {
            $this->currencyQueries = new CurrencyQueries();
            $this->twig = TwigConfig::create();
        }
    }

?>