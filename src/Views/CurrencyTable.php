<?php

    namespace App\Views;

    class CurrencyTable
    {
        public function showTable() {
            $query = $this->currencyQueries->getCurrencies();

            if($query != null) {
                echo "<table border=1>";
                echo "
                <thead>
                    <th>Lp.</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Price</th>
                </thead>";
                while($currencyArray = $query->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>{$currencyArray['currency_id']}</td>
                            <td>{$currencyArray['name']}</td>
                            <td>{$currencyArray['code']}</td>
                            <td>{$currencyArray['price']}</td>
                        </tr>
                    ";
                }
                echo "</table>";
            }
        }
    }

?>