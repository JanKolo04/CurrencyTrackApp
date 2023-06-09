<?php

    namespace App\Queries;

    use Config\DataBaseConnection;

    class CurrencyQueries extends ValidQueries
    {
        private $con = null;

        public function __construct()
        {
            $this->con = DataBaseConnection::connect();
        }

        /**
         * setCurrencies() method to insert or update currencies data in database
         * 
         * @param array $allCurrenciesArray array of all currencies which was fetched from api
         * @return void
         */
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

        /**
         * getCurrencies() method to fetch all currencies from database
         * 
         * @return object
         */
        public function getCurrencies(): object
        {
            $sql = "SELECT * FROM currencies";
            $query = $this->con->query($sql);

            return $query;
        }

        /**
         * findCurrencyByCode() method to find currency in database by code
         * 
         * @param string $code string with currency code
         * @return object|null
         */
        public function findCurrencyByCode(string $code): ?float
        {
            $sql = "SELECT price FROM currencies WHERE code='{$code}'";
            $query = $this->con->query($sql);

            // valid query
            if($this->valid($query)) {
                return $query->fetch_assoc()['price'];
            }
            return null;
        }
    }

?>