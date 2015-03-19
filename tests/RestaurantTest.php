<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $DB = new PDO('pgsql:host=localhost;dbname=test_best_rest');

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Restaurant::deleteAll();
        }

        function test_getCuisine()
        {
            //Arrange
            $name = "BBQ";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $restaurant_name = "Twiggys BBQ";
            $phone = "8088088080";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $phone, $cuisine_id, $id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getCuisine();

            //Assert
            $this->assertEquals("BBQ", $result);
        }

        function test_setId()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $restaurant_name = "Fiorentinos";
            $phone = "9716660666";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $phone, $cuisine_id, $id);
            $test_restaurant->save();

            //Act
            $test_restaurant->setId(2);

            //Assert
            $result = $test_restaurant->getId();
            $this->assertEquals(2, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $restaurant_name = "Fiorentinos";
            $phone = "9716660666";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $phone, $cuisine_id, $id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCuisineId()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $restaurant_name = "Fiorentinos";
            $phone = "9716660666";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $phone, $cuisine_id, $id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getCuisineId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $restaurant_name = "Fiorentinos";
            $phone = "9716660666";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $phone, $cuisine_id, $id);

            //Act
            $test_restaurant->save();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $restaurant_name = "Fiorentinos";
            $phone = "9716660666";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $phone, $cuisine_id, $id);
            $test_restaurant->save();


            $restaurant_name2 = "Digiorno";
            $phone2 = "5650008008";
            $test_restaurant2 = new Restaurant($restaurant_name2, $phone2, $cuisine_id, $id);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $restaurant_name = "Fiorentinos";
            $phone = "9716660666";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $phone, $cuisine_id, $id);
            $test_restaurant->save();

            $restaurant_name2 = "Digiorno";
            $phone2 = "5650008008";
            $test_restaurant2 = new Restaurant($restaurant_name2, $phone2, $cuisine_id, $id);
            $test_restaurant2->save();

            //Act
            Restaurant::deleteAll();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals([], $result);
        }


        function test_find()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $restaurant_name = "Fiorentinos";
            $phone = "9716660666";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $phone, $cuisine_id, $id);
            $test_restaurant->save();

            $restaurant_name2 = "Digiorno";
            $phone2 = "5650008008";
            $test_restaurant2 = new Restaurant($restaurant_name2, $phone2, $cuisine_id, $id);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::find($test_restaurant->getId());

            //Assert
            $this->assertEquals($test_restaurant, $result);
        }

    }
?>
