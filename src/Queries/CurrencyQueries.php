<?php

    namespace App\Queries;

    class CurrencyQueries
    {

        public function setCurrencies(array $allCurrenciesArray)
        {
            // insert into databse every currency from response
            foreach($allCurrenciesArray as $oneCurrencyArray) {
                // if currency isset in database update with new price,
                // but if not insert new currency
                $sql = "INSERT INTO currencies(name, code, price) VALUES(
                    '{$oneCurrencyArray['currency']}',
                    '{$oneCurrencyArray['code']}',
                    {$oneCurrencyArray['mid']}) 
                    ON DUPLICATE KEY UPDATE
                    price={$oneCurrencyArray['mid']}";
                
                $query = $this->con->query($sql);
            }
        }

        public function getCurrencies()
        {
            $sql = "SELECT * FROM currencies";
            $query = $this->con->query($sql);

            if($query->num_rows > 0 && $query != false) {
                return $query->fetch_assco();
            }
            else {
                return null;
            }
        }
    }

?>