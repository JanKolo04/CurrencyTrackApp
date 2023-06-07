<?php

    namespace App\Queries;

    class ValidQueries
    {
        public function valid(object $query): ?object
        {
            if($query->num_rows > 0 && $query != false) {
                return $query;
            }
            else {
                return null;
            }
        }
    }

?>