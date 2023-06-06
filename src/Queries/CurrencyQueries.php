<?php

    namespace App\Queries;

    use Config\DataBaseConnection;

    class CurrencyQueries
    {
        private $con = null;

        public function __construct()
        {
            $this->con = DataBaseConnection::connect();
        }

        public function setCurrencies(array $allCurrenciesArray): void
        {
            // insert into databse every currency from response
            foreach($allCurrenciesArray as $currencyArray) {
                // if currency isset in database update with new price,
                // but if not insert new currency
                $sql = "INSERT INTO currencies(name, code, price) VALUES(
                    '{$currencyArray['currency']}',
                    '{$currencyArray['code']}',
                    {$currencyArray['mid']}) 
                    ON DUPLICATE KEY UPDATE
                    price={$currencyArray['mid']}";
                
                $query = $this->con->query($sql);
            }
        }

        public function getCurrencies(): ?array
        {
            $sql = "SELECT * FROM currencies";
            $query = $this->con->query($sql);

            if($query->num_rows > 0 && $query != false) {
                return $query;
            }
            else {
                return null;
            }
        }
    }

?>