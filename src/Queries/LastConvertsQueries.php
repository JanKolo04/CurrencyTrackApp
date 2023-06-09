<?php

    namespace App\Queries;

    use Config\DataBaseConnection;

    class LastConvertsQueries
    {
        private $con = null;

        public function __construct()
        {
            $this->con = DataBaseConnection::connect();
        }

        public function getConverts(): object
        {
            $sql = "SELECT * FROM last_converts";
            $query = $this->con->query($sql);

            return $query;
        }

        public function uploadConvert(int $ammount, float $convertedAmmount, string $firstCurrency, string $secondCurrency): void
        {
            $sql = "INSERT INTO last_converts(first_currency, second_currency, ammount, converted_ammount)
                    VALUES('{$firstCurrency}', '{$secondCurrency}', {$ammount}, {$convertedAmmount})";
            $query = $this->con->query($sql);
    
        }

    }

?>