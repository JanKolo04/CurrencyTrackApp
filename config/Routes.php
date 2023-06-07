<?php

    namespace Config;

    use App\Controllers\MainPageController;

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
                    $mainPage = new MainPageController();
                    $mainPage->show();
                    break;
                default:
                    include 'src/error.php';
            }
        }
    }

?>