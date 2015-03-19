<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";

    $app = new Silex\Application();
    $app['debug']=true;

    //create a new PHP data object with route to our best_rest database
    $DB = new PDO('pgsql:host=localhost;dbname=best_rest');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    //the home page route
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.twig', array('cuisines' => Cuisine::getAll()));
    });

    // $app->get("/restaurants", function() use ($app) {
    //     return $app['twig']->render('restaurants.twig', array('restaurants' => Restaurant::getAll()));
    // });
    //
    // $app->get("/cuisines", function() use ($app) {
    //     return $app['twig']->render('cuisines.twig', array('cuisines' => Cuisine::getAll()));
    // });
    //
    $app->get("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisines.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    //individual restaurant pages
    $app->get("/restaurants/{id}", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        return $app['twig']->render('restaurant.twig', array('restaurant' => $restaurant));
    });

    $app->post("/relevant_restaurants", function() use ($app) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $cuisine_id = $_POST['cuisine_id']; //does/should this get set in a user input form??
        $restaurant = new Restaurant($name, $phone, $cuisine_id, $id = null);
        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisines.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->get("/show_all_restaurants", function() use ($app) {
        $all_restaurants = Restaurant::getAll();
        return $app['twig']->render('all_restaurants.twig', array('restaurants' => $all_restaurants));
    });
    //
    // $app->post("/delete_restaurants", function() use ($app) {
    //     Restaurant::deleteAll();
    //     return $app['twig']->render('index.twig', array ('cuisines' => Cuisine::getAll()));
    // });

    $app->post("/cuisines", function() use ($app) {
        $cuisine = new Cuisine($_POST['new_cuisine']);
        $cuisine->save();
        return $app['twig']->render('index.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/delete_all", function() use ($app) {
        Cuisine::deleteAll();
        Restaurant::deleteAll();
        return $app['twig']->render('index.twig', array('cuisines' => Cuisine::getAll()));
    });

    return $app;
?>
