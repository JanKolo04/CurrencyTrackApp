<?php

    namespace Api;

    class ApiConnection 
    {
        public static function connect(string $url) 
        {
            $response = file_get_contents($url);

            if($response != null) {
                // parse response into php array
                $data = json_decode($response, true);
                // choose only needed data from resposne
                $data = $data[0]['rates'];
                return $data;
            }
            else {
                return "Error";
            }
        }
    }

?>