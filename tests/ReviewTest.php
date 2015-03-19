<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";
    require_once "src/Review.php";

    $DB = new PDO('pgsql:host=localhost;dbname=test_best_rest');

    class ReviewTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Review::deleteAll();
        }

        function test_save()
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

            $test_user = "Bob";
            $test_stars = 5;
            $test_body = "Great";
            $test_rest_id = $test_restaurant->getId();
            $test_review = new Review($test_user, $test_stars, $test_body, $test_rest_id, $cuisine_id, $id);

            //Act
            $test_review->save();

            //Assert
            $result = Review::getAll();
            $this->assertEquals($test_review, $result[0]);
        }

        function test_setUsername()
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

            $test_user = "Bob";
            $test_stars = 5;
            $test_body = "Great";
            $test_rest_id = $test_restaurant->getId();
            $test_review = new Review($test_user, $test_stars, $test_body, $test_rest_id, $cuisine_id, $id);
            $test_review->save();

            //Act
            $test_review->setUsername("Jimmi");


            //Assert
            $result = $test_review->getUsername();
            $this->assertEquals("Jimmi", $result);
        }




    }
?>
