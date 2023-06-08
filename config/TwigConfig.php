<?php

    namespace Config;

    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;
    
    class TwigConfig
    {
        /**
         * create() method to setup twig configuration
         * 
         * @return Enviroment
         */
        public static function create(): Environment
        {
            $loader = new FilesystemLoader('src/Templates/');
            $twig = new Environment($loader, ['debug' => true]);
    
            return $twig;
        }
    }

?>