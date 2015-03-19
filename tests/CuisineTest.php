<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $DB = new PDO('pgsql:host=localhost;dbname=test_best_rest');

    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Cuisine::deleteAll();
        }

        function testUpdate()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $new_name = "Chinese";

            //Act
            $test_cuisine->update($new_name);

            //Assert
            $this->assertEquals("Chinese", $test_cuisine->getName());
        }

        function testDeleteCuisineRestaurants()
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
            $test_cuisine->delete();
            $result = Restaurant::getAll();

            //Assert

            $this->assertEquals([], $result);
        }

        function test_getName()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_Cuisine = new Cuisine($name, $id);

            //Act
            $result = $test_Cuisine->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Italian";
            $id = 1;
            $test_Cuisine = new Cuisine($name, $id);

            //Act
            $result = $test_Cuisine->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_setId()
        {
            //Arrange
            $name = "Chinese";
            $id = null;
            $test_Cuisine = new Cuisine($name, $id);

            //Act
            $test_Cuisine->setId(2);

            //Assert
            $result = $test_Cuisine->getId();
            $this->assertEquals(2, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_Cuisine = new Cuisine($name, $id);
            $test_Cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_Cuisine, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $name2 = "Chinese";
            $id2 = null;
            $test_Cuisine = new Cuisine($name, $id);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2, $id2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_Cuisine, $test_Cuisine2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $name2 = "Chinese";
            $id2 = null;
            $test_Cuisine = new Cuisine($name, $id);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2, $id2);
            $test_Cuisine2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Italian";
            $id = 1;
            $name2 = "Chinese";
            $id2 = 2;
            $test_Cuisine = new Cuisine($name, $id);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2, $id2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::find($test_Cuisine->getId());

            //Assert
            $this->assertEquals($test_Cuisine, $result);
        }

        function testGetRestaurants()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $cuisine_id = $test_cuisine->getId();

            $restaurant_name = "Fiorentinos";
            $phone = "9716660666";
            $test_restaurant = new Restaurant($restaurant_name, $phone, $cuisine_id, $id);
            $test_restaurant->save();

            $restaurant_name2 = "Kyles Grinds";
            $phone2 = "5750088888";
            $test_restaurant2 = new Restaurant($restaurant_name2, $phone2, $cuisine_id, $id);
            $test_restaurant2->save();

            //Act
            $result = $test_cuisine->getRestaurants();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function testDelete()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name2 = "Chinese";
            $test_cuisine2 = new Cuisine($name2, $id);
            $test_cuisine2->save();

            //Act
            $test_cuisine->delete();

            //Assert
            $this->assertEquals([$test_cuisine2], Cuisine::getAll());
        }
    }

?>
