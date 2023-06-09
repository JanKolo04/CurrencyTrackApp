<?php

    namespace App\Queries;

    class ValidQueries
    {
        /**
         * valid() method to valid query
         * 
         * @param object $query object with fetch data from database or empty object
         * @return object|null
         */
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