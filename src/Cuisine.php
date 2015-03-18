<?php
    class Cuisine
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
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

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function save()
        {
            $banana = $GLOBALS['DB']->query("INSERT INTO cuisines (name) VALUE ('{$this->getName()}') RETURNING id;");
            $result = $banana->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE cuisine_id = {$this->getId()};");
        }

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine) {
                $name = $cuisine['name'];
                $id = $cuisine['id'];
                $new_cuisine = new Cuisine($name, $id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines *;");//Clears all values from Database
        }

        static function find($search_id)
        {
            $found_cuisine = null; //sets the variable to a null value.
            $cuisines = Cuisine::getAll(); //calls the result of the getAll function and sets it to the variable
            foreach($cuisines as $cuisine) { //verifies the match between the requested value and the existing data
                $cuisine_id = $cuisine->getId();
                if ($cuisine_id == $search_id) {
                  $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;//show confirmed match
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE cuisines SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function getRestaurants()
        {
            $restaurants = array();
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = {$this->getId()} ORDER BY due_date;");
            foreach($returned_restaurants as $resty) {
                $name = $resty['name'];
                $phone = $resty['phone'];
                $id = $resty['id'];
                $cuisine_id = $resty['cuisine_id'];
                $new_restaurant = new Restaurant($name, $phone, $cuisine_id, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }
    }
?>
