<?php

    class Restaurant
    {
        private $name;
        private $phone;
        private $cuisine_id;
        private $id;

        function __construct($name, $phone, $cuisine_id, $id = null)
        {
            $this->name = $name;
            $this->phone = $phone;
            $this->cuisine_id = $cuisine_id;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function setPhone($new_phone)
        {
            $this->phone = (string) $new_phone;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function setCuisineId($new_cuisine_id)
        {
            $this->cuisine_id = (int) $new_cuisine_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function getCuisine()
        {
            //talk to DB grab cuisine name using the cuisine id
            //must talk to cuisine table
            //cuisineId in the RESTARURANTS table = id in CUISINES table
            //select from cuisines where id = cuisineId
            $statement = $GLOBALS['DB']->query("SELECT name FROM cuisines WHERE id = {$this->getCuisineId()};");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            // var_dump($statement);
            return $result['name'];
        }

        function save()
        {
            $blood_type = $GLOBALS['DB']->query("INSERT INTO restaurants (name, phone, cuisine_id) VALUES ('{$this->getName()}', {$this->getPhone()}, {$this->getCuisineId()}) RETURNING id;");
            $result = $blood_type->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $phone = $restaurant['phone'];
                $cuisine_id = $restaurant['cuisine_id'];
                $id = $restaurant['id'];
                $new_restaurant = new Restaurant($name, $phone, $cuisine_id, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function find($search_id)//search by cuisine? or by resty id??
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            foreach($restaurants as $restaurant) {
                $restaurant_id = $restaurant->getId();
                if ($restaurant_id == $search_id) {
                    $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants *;");
        }

    }


?>
